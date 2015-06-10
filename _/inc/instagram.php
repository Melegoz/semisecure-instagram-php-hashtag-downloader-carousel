<?php
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

/* Instagram API Keys */
define("clientID", '709e94613d41468d93a6ef4788783e14');
define("clientSecret", 'fa6483b66e5b42d7b40b594774440a38');
define("redirectURI", 'http://timherbert.net/instagram-php-sideshow/index.php');
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
  
  return $results['data'][0]['id'];
  
}

// Print images
function printHashedImages($access_token){
  $url = 'https://api.instagram.com/v1/tags/savor/media/recent?access_token='.$access_token;
  $instagramInfo = connect_to_instagram($url);
  $results = json_decode($instagramInfo, true);
  
  echo '<div id="instagram-reponse">';
  //Parse through results/images
  foreach($results['data'] as $items){
    $image_url = $items['images']['low_resolution']['url'];
    //echo '<img src="'.$image_url.'"><br>';
    savePicture($image_url);
  }
  echo '</div>';
}

//Save the Picture
function savepicture($image_url){
  //echo $image_url . '<br>';
  $filename = basename($image_url);
  //make sure image doesn't already exist
  

  $destination = imageDirectory.$filename;

  if (file_exists($destination)) {
      //echo "The file $filename exists<br>";
  } else {
      //echo "The file $filename does not exist<br>";     
    file_put_contents($destination, file_get_contents($image_url));
  }
  
}


// Print images
function printUserImages($userID){
  $url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id='.clientID.'&count=5';
  $instagramInfo = connect_to_instagram($url);
  $results = json_decode($instagramInfo, true);
  
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

  
  $userID = getUserID($userName);
  printHashedImages($access_token);
  echo '<script type="text/javascript">window.location.assign("http://client.savorweb.com/republicpi/republicpi.php")</script>';
  
} 
?>