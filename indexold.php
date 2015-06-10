<?php include("_/inc/head.php"); ?>

		<title>Instagram Plugin</title>
		<meta name="description" content="..." />
		<meta name="keywords" content="..." />
</head>
<body>



<div class="landing">

	<img src="_/img/landing.jpg" alt="Instagram Plugin">	
	
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
	<div class="row">
		<p class="copyright">&copy;Re.Pub.Lic*Pi. All rights reserved.</p>
	</div>
</div>



<!-- jQuery templates. Not rendered by the browser. Notice the type attributes -->

<script id="headingTpl" type="text/x-jquery-tmpl">


<div class="facebook-head">
	<img class="avatar" src="${picture.data.url}"><a href="#"><span class="facebook-name">${name} <br>FaceBook Page</span></a>

<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
</div>
</div>

</script>

<script id="feedTpl" type="text/x-jquery-tmpl">
<li>
	
	<div class="status">
		<p><a href="http://www.facebook.com/profile.php?id=${from.id}" target="_blank">${from.name}</a></p>
		<p class="message">{{html message}}</p>
		{{if type == "link" }}
			<div class="attachment">
				<div class="attachment-data">
					<p class="name"><a href="${link}" target="_blank">${name}</a></p>
					<p class="caption">${caption}</p>
					<p class="description">${description}</p>
				</div>
			</div>
		{{/if}}
	</div>
	<p class="facebook-link"><a href="http://www.facebook.com/profile.php?id=${from.id}" target="_blank">>>View On Facebook</a></p>
	
</li>
</script>




<?php include("_/inc/foot.php"); ?>