<?php include("_/inc/head.php"); ?>

		<title>Instagram Plugin</title>
		<meta name="description" content="..." />
		<meta name="keywords" content="..." />
</head>
<body>



<div class="landing">
	
</div>



<?php include("_/inc/nav.php"); ?>

<div class="instagram-wrapper">
	<div class="row">
	<div class="wrap">
	<div class="instagram-controls">
	    <button class="btn prev"></button>
	    <button class="btn next"></button>
	</div>
		<h2>Instagram Photo Feed</h2>
	    <div class="handle">
	      <div class="mousearea"></div>
	  </div>

	  <div class="frame effects" id="effects">
	    <ul class="clearfix">
<?php
$folder = 'files/';
$filetype = '*.*';
$files = glob($folder.$filetype);
$count = count($files);

for ($i = 0; $i < $count; $i++) {

    echo '<li><img src="'.$files[$i].'" /></li>';
    //echo substr($files[$i],strlen($folder),strpos($files[$i], '.')-strlen($folder));

}

?>
	    </ul>
	    
	    <p class="copyright"></p>
	  </div><!-- end of wrap-->


	<div class="remodal-bg">
		<div class="instagram-submit">
		    <a class="show_button" href="#modal">>> Click Here To Submit Yours</a>
		</div>
	    <div class="remodal" data-remodal-id="modal">
	        
	        
	        <!-- start of upload -->
	        
	    <span class="btn btn-success fileinput-button">
	    <span>Select files...</span>
	    <!-- The file input field used as target for the file upload widget -->
	    <input id="fileupload" type="file" name="files[]" multiple>
	  </span>
	  
	  
	  <!-- The global progress bar -->
	  <p>Upload progress</p>
	  <div id="progress" class="progress progress-success progress-striped">
	    <div class="bar"></div>
	  </div><!-- end of remodal -->
	  
	  
	  
	  <!-- The list of files uploaded -->
	  <p>Files uploaded:</p>
	  <ul id="files"></ul>
	        
	        <!-- end of upload-->
	        
	       
	  </div>
	</div><!-- end of remodal -->

	</div>
	</div>
</div>



<!-- jQuery templates. Not rendered by the browser. Notice the type attributes -->





<?php include("_/inc/foot.php"); ?>