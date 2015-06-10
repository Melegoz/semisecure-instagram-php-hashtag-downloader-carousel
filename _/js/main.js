
//Set Array for selected images to delete or push live.
var images = [];
 
//Selects all top
function selectAll(e){
  $('.instagram__downloaded__container ul li img').addClass('instagram-selected');
  $('.instagram__downloaded__container ul li').append('<span class="instagram-selected-indicator"></span>');
  e.preventDefault();
}
//Selects all bottom or live images
function selectAll1(e){
  $('#effects1 ul li img').addClass('instagram-selected1');
  $('#effects1 ul li').append('<span class="instagram-selected-indicator1">&nbsp;</span>');  
  e.preventDefault();
}

function deselectAll(e){
	$('#effects1 ul li img').removeClass('instagram-selected1');
	$('.instagram__downloaded__container ul li img').removeClass('instagram-selected');
  $('.instagram-selected-indicator, .instagram-selected-indicator1').remove();
	e.preventDefault();
}

 function postData() {
     
    $('.instagram-selected').each(function(){
      var source = $(this).attr('src');
      images.push(source);
    });

    $('.instagram-selected1').each(function(){
      var source = $(this).attr('src');
      images.push(source);
    });

    var something = JSON.stringify(images);

    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    }
    else {
        throw new Error("Ajax is not supported by this browser");
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status == 200 && xhr.status < 300) {
                document.getElementById('response').innerHTML = xhr.responseText;
            }
        }
    }
    xhr.open('POST', 'index.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("img=" + images);
    setTimeout(function(){ window.location = window.location; },500);
}
function postHashtag() {
    var hashtag = $('#hashtag').val(); 
    //window.location.assign("https://api.instagram.com/oauth/authorize/?client_id=709e94613d41468d93a6ef4788783e14&redirect_uri=http://timherbert.net/semisecure-instagram-php-downloader-carousel/index.php&response_type=code")
    var something = JSON.stringify(hashtag);
    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    }
    else {
        throw new Error("Ajax is not supported by this browser");
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status == 200 && xhr.status < 300) {
                document.getElementById('response').innerHTML = xhr.responseText;
            }
        }
    }
    xhr.open('POST', 'index.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("hashtag=" + hashtag);
    setTimeout(function(){ window.location = 'https://api.instagram.com/oauth/authorize/?client_id=709e94613d41468d93a6ef4788783e14&redirect_uri=http://timherbert.net/semisecure-instagram-php-hashtag-downloader-carousel/index.php&response_type=code'; },500);
}


function deleteData() {
    $('.instagram-selected').each(function(){
      var source = $(this).attr('src');
      images.push(source);
    });

    $('.instagram-selected1').each(function(){
      var source = $(this).attr('src');
      images.push(source);
    });

    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    }
    else {
        throw new Error("Ajax is not supported by this browser");
    }
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status == 200 && xhr.status < 300) {
                document.getElementById('response').innerHTML = xhr.responseText;
            }
        }
    }
    xhr.open('POST', 'index.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('delete=delete&img_delete=' + images);
    setTimeout(function(){ window.location = window.location; },500);
    
}
var buttonToggle = 0;
$('button.hashtagDropdown').click(function(){
    var position = $(this).position();
    var height = $(this).height();
    if(buttonToggle == 0){
        $('.hashtag').css('top',height+position.top+2);
        $('.hashtag').slideDown(300);
        buttonToggle = 1;
    } else {
        $('.hashtag').slideUp(300);
        buttonToggle = 0
    }   
});

// Select Images 
// Select top
$('.instagram__downloaded__container ul li img').click(function(){
    var parent = $(this).parent();
    var hasClass = $(this).hasClass('instagram-selected');
    if(hasClass){
      var siblings = $(this).siblings();
      siblings.remove();
    } else {
      $(parent).append('<span class="instagram-selected-indicator"></span>');  
    }

    $(this).toggleClass('instagram-selected');

});
//Select bottom
$('#effects1 ul li img').click(function(){
    
    var parent = $(this).parent();

    var hasClass = $(this).hasClass('instagram-selected1');
    if(hasClass){
      var siblings = $(this).siblings();
      siblings.remove();
    } else {
      $(parent).append('<span class="instagram-selected-indicator1">&nbsp;</span>');  
    }

    $(this).toggleClass('instagram-selected1');
});

