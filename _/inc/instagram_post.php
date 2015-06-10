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