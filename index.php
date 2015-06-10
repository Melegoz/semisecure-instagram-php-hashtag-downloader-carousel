<?php
session_start();
// Array of usernames and passwords, add as many as you want or populate from database.
// Username => password
$userinfo = array(
                'tim'=>'temp',
                'test'=>'temp1',
                'test2'=>'temp2'
                );

if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    header('Location:  ' . $_SERVER['PHP_SELF']);
}

if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
    }else {
        //Invalid Login
        echo 'Invalid Username or Password';
    }
}

//Delete selected items coming in from $_POST['img_delete'] with $_POST['delete'] flagged to run function.
if (isset($_POST['delete'])){
   $img = $_POST['img_delete'];
   $exploded=explode(",", $img);
   $trimmed = str_replace('images/', '', $exploded);

   foreach($exploded as $items){
      unlink($items);
   }
   die;
 }

// File Copy Function
if (isset($_POST['img'])){ 
  $img = $_POST['img'];
   $exploded=explode(",", $img);
   $trimmed = str_replace('images/', '', $exploded);
   
   foreach($exploded as $items){
      copy($items,'files/keep/'.$items);   
   }
  
  
   die;
  } // End file copy

?>


<?php
/*
Instagram Connection Script compliments of NewBoston Youtube channel. Modified to suit my needs.
*/
set_time_limit(0);
ini_set('default_socket_timeout', 300);

/* Instagram API Keys */
define("clientID", 'instagram api client');
define("clientSecret", 'instagram api secret');
define("redirectURI", 'http://your-url-here.com');
define("imageDirectory", 'files/');

$hashtag = '';
if(isset($_POST['hashtag'])){
 $hashtag = $_POST['hashtag'];
 $_SESSION['hashtag'] = $hashtag;
 die;
} 
define("hashtag",'design');

//Using Curl to connect to instagram
function connect_to_instagram($url){
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false
  ));
  $result = curl_exec($ch);
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
  $url = 'https://api.instagram.com/v1/tags/'.$_SESSION['hashtag'].'/media/recent?access_token='.$access_token;
  //echo $url;
  //die;
  $instagramInfo = connect_to_instagram($url);
  $results = json_decode($instagramInfo, true);
  //Parse through results/images
  foreach($results['data'] as $items){
    $image_url = $items['images']['low_resolution']['url'];
    savePicture($image_url);
  }
}

//Save the Picture
function savepicture($image_url){
  $filename = basename($image_url);
  //make sure image doesn't already exist
  $destination = imageDirectory.$filename;
  if (file_exists($destination)) {
  } else {
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
  
  //Refreshes page and gets rid of Instagram Access Token Code so users don't freak from the user doesn't freak from error
  echo '<script type="text/javascript">window.location.assign("http://timherbert.net/semisecure-instagram-php-hashtag-downloader-carousel/index.php")</script>';
  
} 
?>



<html>
  <head>
  <link href="_/css/screen.css" rel="stylesheet" type="text/css" media="all"/>
  <link href="_/css/main.css" rel="stylesheet" type="text/css" media="all"/>
  <title>Instagram PHP semisecure-instagram-php-hashtag-downloader-carousel</title>
  <style>
  </style>
  </head>
  <body>

<?php 
if($_SESSION['username']){ 
?>
  


<header class="pagehead pullwidth">
  <section class="row">
    <a class="logo-back" href="index.php"><img src="http://timherbert.net/wp-content/themes/angular_th/img/logo.png" alt="TH logo"></a>
    <nav class="instagram__backend__nav">
      <ul>
        <li class="logged__in">Logged in: <?=$_SESSION['username']?><br><a href="?logout=1">Logout</a></li>
  
      </ul>
    </nav>
  </section>
</header>
  <div class="instagram__backend__actions">
    <div class="row">
    <button class="hashtagDropdown">Instagram Download</button>
    <div class="hashtag">
      <input id="hashtag" type="text" value="hashtag">
      <button onClick="postHashtag()">Start Download</button>
    </div>
    <button onclick="postData()">Make Live</button>
    <button onclick="deleteData()">Delete Selected</button>
    <button onclick="selectAll()">Select All Top</button>
    <button onclick="selectAll1()">Select All Bottom</button>
    <button onclick="deselectAll()">Deselect All</button>
  </div>
  </div>
  
<div class="row">
  <div class="instagram__downloaded">
    <h2>Downloaded Files</h2>
    <div class="instagram__downloaded__container">

    		
        <ul>
    <?php
    $folder = 'files/';
    $filetype = '*.*';
    $files = glob($folder.$filetype);
    $count = count($files);

    for ($i = 0; $i < $count; $i++) {

    echo '<li><img src="'.$files[$i].'" /></li>';
    }

    ?>
        </ul>
    	
    </div>
  </div>
</div>

<div class="instagram-wrapper">	
	<div class="row">
	<div class="wrap">
  <div class="instagram-controls1">
      <button class="btn prev"></button>
      <button class="btn next"></button>
  </div>
		<h2>Live Photos</h2>
	    <div class="handle">
	      <div class="mousearea"></div>
		</div>

	  <div class="frame effects" id="effects1">
	    <ul class="clearfix">
<?php
$folder1 = 'files/keep/files/';
$filetype1 = '*.*';
$files1 = glob($folder1.$filetype1);
$count1 = count($files1);

for ($i = 0; $i < $count1; $i++) {

    echo '<li><img src="'.$files1[$i].'" /></li>';
}

?>
	    </ul>
	  </div>
	</div>
	</div>
</div>


<div id="response"></div>
            
<?php
// Different Login front end.  
} else { 
?>
        
        <header class="pagehead pullwidth">
          <section class="row">
            <a class="logo-back" href="index.php"><img src="http://timherbert.net/wp-content/themes/angular_th/img/logo.png" alt="TH logo"></a>

           

            <nav class="instagram__backend__nav">
              <ul>
                <li class="logged__in">Logged out: <br> Please Log in to Continue. </li>
          
              </ul>
            </nav>
          </section>
        </header>

        <div class="row">
          <form name="login" action="" method="post">
              <label>Username:  </label><input type="text" name="username" value="" /><br>
              <label>Password:  </label><input type="password" name="password" value="" /><br>
              <input type="submit" name="submit" value="Submit" />
          </form>
          <p class="editable" id="untitled-region-1">&nbsp;</p>
        </div>
<?php } // Login Form

 ?>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="_/js/sly.min.js"></script>
        <script type="text/javascript" src="_/js/main.js"></script>

<script type="text/javascript">

jQuery(function($){
  'use strict';

  // -------------------------------------------------------------
  //   Effects
  // -------------------------------------------------------------
(function () {
    var $frame = $('#effects1');
    var $wrap  = $frame.parent();

    // Call Sly on frame
    $frame.sly({
      horizontal: 1,
      itemNav: 'forceCentered',
      smart: 1,
      activateMiddle: 1,
      activateOn: 'click',
      mouseDragging: 1,
      touchDragging: 1,
      releaseSwing: 1,
      startAt: 3,
      //scrollBar: $wrap.find('.scrollbar'),
      scrollBy: 1,
      speed: 300,
      elasticBounds: 1,
      easing: 'swing',
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 0,

      // Buttons
      prev: $('.instagram-controls1').find('.prev'),
      next: $('.instagram-controls1').find('.next')
    });
  }());
});

</script>
    </body>
</html>






