<?php
session_start(); $username = $password = $userError = $passError = '';
if(isset($_POST['sub'])){
  $username = $_POST['username']; $password = $_POST['password'];
  if($username === 'admin' && $password === 'password'){
    $_SESSION['login'] = true;//header('LOCATION:wherever.php'); die();
  }
  if($username !== 'admin')$userError = 'Invalid Username';
  if($password !== 'password')$passError = 'Invalid Password';
}
echo "<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
   <head>
     <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Login</title>
     <style type='text.css'>
       @import common.css;
     </style>
   </head>
<body>
  <form name='input' action='{$_SERVER['PHP_SELF']}' method='post'>
    <label for='username'></label><input type='text' value='$username' id='username' name='username />
    <div class='error'>$userError</div>
    <label for='password'></label><input type='password' value='$password' id='password' name='password />
    <div class='error'>$passError</div>
    <input type='submit' value='Home' name='sub' />
  </form>
</body>
</html>";
?>



<?php 
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

/* Instagram API Keys */

define("clientID", '709e94613d41468d93a6ef4788783e14');
define("clientSecret", 'fa6483b66e5b42d7b40b594774440a38');
define("redirectURI", 'http://timherbert/instagram-php-slideshow/index.php');
define("imageDirectory", 'files/');


function connect_to_instagram($url){
	$ch = curl_init();
	
	curl_setopt_array($ch, array(
		
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false
		
	));
	
	$result = curl_exec($ch);
	//var_dump($result);die;
	curl_close($ch);
	return $result;
}


//Get Instagram userID

function getUserID($userName){
	$url = 'https://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID;
	$instagramInfo = connect_to_instagram($url);
	$results = json_decode($instagramInfo, true);
	
	//var_dump($results);die;
	//echo $results['data'][0]['id'];
	return $results['data'][0]['id'];
	
}


// Print images
function printHashedImages($access_token){
	$url = 'https://api.instagram.com/v1/tags/savor/media/recent?access_token='.$access_token;
	$instagramInfo = connect_to_instagram($url);
	$results = json_decode($instagramInfo, true);
	
	//Parse through results/images
	foreach($results['data'] as $items){
		$image_url = $items['images']['low_resolution']['url'];
		//echo '<img src="'.$image_url.'"><br>';
		savePicture($image_url);
	}
}

//Save the Picture
function savepicture($image_url){
	//echo $image_url . '<br>';
	$filename = basename($image_url);
	//make sure image doesn't already exist
	
//$filename_path_full = imageDirectory.$filename;
//echo $filename_path_full . '<br>';
$destination = imageDirectory.$filename;

if (file_exists($destination)) {
    echo "The file $filename exists<br>";
} else {
    echo "The file $filename does not exist<br>";
    
	file_put_contents($destination, file_get_contents($image_url));
}

	
}


// Print images
function printUserImages($userID){
	//echo 'hi';
	$url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id='.clientID.'&count=5';
	$instagramInfo = connect_to_instagram($url);
	$results = json_decode($instagramInfo, true);
	
	//var_dump($results);die;
	
	//Parse through results/images
	foreach($results['data'] as $items){
		$image_url = $items['images']['low_resolution']['url'];
		echo '<img src="'.$image_url.'"><br>';
	}
}


if($_GET['code']){
	//logged in
	$code = $_GET['code'];
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array(
		'client_id' => clientID,
		'client_secret' => clientSecret,
		'grant_type' =>  'authorization_code',
		'redirect_uri' =>  redirectURI,
		'code' =>  $code
	);
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$result =  curl_exec($curl);
	curl_close($curl);
	
	$results = json_decode($result, true);
	$userName = $results['user']['username'];
	$access_token = $results['access_token'];
	//var_dump($access_token);die;

	
	//var_dump($results);die;
	$userID = getUserID($userName);
	//echo $userID;
	//var_dump($userID);die;
	//printUserImages($userID);
	//return $userID;
	printHashedImages($access_token);
	
	
	
	
	?> 
<?php } else { //logged out ?>	
<!doctype html>
<html>
<body>
	<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">Download Images</a>
</body>
</html>

<?php
}
?>

