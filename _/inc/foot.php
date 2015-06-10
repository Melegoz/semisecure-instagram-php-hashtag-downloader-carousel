


<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<script src="_/js/responsive-nav.min.js"></script>
<script src="_/js/responsive-accordion.min.js"></script>
<script src="_/js/swipe.min.js"></script>
<script type="text/javascript">
	var navigation = responsiveNav(".nav-collapse", {
		customToggle: "#nav-toggle"
	});

	var slider = new Swipe(document.getElementById('slider'), {
    disableScroll: false,
    stopPropagation: true,
    auto: 6000,
  });
</script>

<script type="text/javascript">
jQuery(function($){
  'use strict';

  // -------------------------------------------------------------
  //   Effects
  // -------------------------------------------------------------
  (function () {
    var $frame = $('#effects');
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
      startAt: 4,
      //scrollBar: $wrap.find('.scrollbar'),
      scrollBy: 1,
      speed: 300,
      elasticBounds: 1,
      easing: 'swing',
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 0,

      // Buttons
      prev: $('.instagram-controls').find('.prev'),
      next: $('.instagram-controls').find('.next')
    });
  }());
});
</script>


<script type="text/javascript" src="_/js/jquery.remodal.js"></script>
<script type="text/javascript" src="_/js/sly.min.js"></script>
<script type="text/javascript" src="_/js/imagesloaded.min.js"></script>
<script src="_/js/jquery.ui.widget.js"></script>
<script src="_/js/jquery.iframe-transport.js"></script>
<script src="_/js/jquery.fileupload.js"></script>


  <!-- JavaScript used to call the fileupload widget to upload files -->
  <script>
    // When the server is ready...
    $(function () {
        'use strict';
        
        // Define the url to send the image data to
        var url = 'files.php';
        
        // Call the fileupload widget and set some parameters
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                // Add each uploaded file name to the #files list
                $.each(data.result.files, function (index, file) {
                    $('<li/>').text(file.name).appendTo('#files');
                });
            },
            progressall: function (e, data) {
                // Update the progress bar while files are being uploaded
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css(
                    'width',
                    progress + '%'
                );
            }
        });
    });
    
  </script>

<script type="text/javascript" src="_/js/stickUp.min.js"></script>
<script type="text/javascript" src="_/js/jquery.tmpl.min.js"></script>
<script type="text/javascript" src="_/js/main.js"></script>
<script type="text/javascript">
  //initiating jQuery
  jQuery(function($) {
    $(window).load( function() {
      //enabling stickUp
      setTimeout(function(){ $('header.pagehead').stickUp(); }, 30);
    });
  });

</script>


</body>

</html>












