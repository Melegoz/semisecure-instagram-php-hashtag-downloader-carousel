<?php include_once('_/inc/instagram_post.php'); ?>
<?php include_once('_/inc/instagram.php'); ?>
<html>
  <head>
  <link href="_/css/screen.css" rel="stylesheet" type="text/css" media="all"/>
  <link href="_/css/main.css" rel="stylesheet" type="text/css" media="all"/>
  <title>RepublicPi Instagram Plugin</title>
  <style>
  </style>
  </head>
  <body>

<?php 
if($_SESSION['username']){ 
?>
  


<header class="pagehead pullwidth">
  <section class="row">
    <a class="logo-back" href="index.php"><img src="_/img/savor-logo.png" alt="SavorWeb Logo"></a>

   

    <nav class="instagram__backend__nav">
      <ul>
        <li class="logged__in">Logged in: <?=$_SESSION['username']?><br><a href="?logout=1">Logout</a></li>
  
      </ul>
    </nav>
  </section>
</header>

  <div class="instagram__backend__actions">
    <div class="row">
    <button><a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">Instagram Download</a></button>

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
            
<?php } else { ?>
        
        <header class="pagehead pullwidth">
          <section class="row">
            <a class="logo-back" href="index.php"><img src="_/img/savor-logo.png" alt="SavorWeb Logo"></a>

           

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






