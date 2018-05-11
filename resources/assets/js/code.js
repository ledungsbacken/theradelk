$(document).ready(function() {

    $('.sharer').click(function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });

    $("#toggleComments").click(function() {
      $("#disqus_thread").slideToggle("fast", function() {});
    });

    $('#postText-FullPage p').each(function(i){
        if ( ($(this).find('img').length) &&
             (!$.trim($(this).text()).length))
        {
            $(this).addClass('imgOnly');
        }
        if ( ($(this).find('iframe').length) &&
             (!$.trim($(this).text()).length))
        {
            $(this).addClass('imgOnly');
        }
    });

    $(window).scroll(function(){
        if($(document).scrollTop() > 250) {
            var newPos = $(document).scrollTop() + 190 ;
            $('#share').css( {top:newPos});
        }
        else {
            $('#share').css( {top:540});
        }
    })

    $(window).scroll(function(){
        if($(document).scrollTop() > 250) {
            var newPos = $(document).scrollTop() + 190 ;
            $('#sharelarge').css( {top:newPos});
        }
        else {
            $('#sharelarge').css( {top:540});
        }
    })

});
$(document).scroll(function() {
  var y = $(this).scrollTop();

  if (y > 250) {
    $('#scrollFollow_nav').fadeIn(5);
    $("#mobile_nav").css({
      'position' : 'fixed',
      'margin-top' : '55px',
      'width' : '100%',
      'box-sizing' : 'border-box',
      'top' : '0',
      'z-index' : '99'
    });
  } else {
  $('#scrollFollow_nav').fadeOut(5);
  $("#mobile_nav").css({
    'position' : 'relative',
    'margin-top' : '0'
  });
  }

  var scrollwin = $(window).scrollTop();
  var articleheight = $('#progressMarker').height() - $(window).height();
  var windowWidth = $(window).width();

  if(scrollwin >= $('#progressMarker').offset().top){
      if(scrollwin <= ($('#progressMarker').offset().top + articleheight)){
          $('#progressBar').css('width', ((scrollwin - $('#progressMarker').offset().top) / articleheight) * 100 + "%"  );
      } else {
          $('#progressBar').css('width',"100%");
      }
  }
  else{
      $('#progressBar').css('width',"0%");
  }

});
$( "#mobile" ).click(function() {
  $( "#mobile_nav" ).slideToggle( "fast", function() {});
});
$( "#searchToggle" ).click(function() {
  $( "#searchField" ).slideToggle( "fast", function() {});
});


$( "#scrollFollowToggle" ).click(function() {
  $("#mobile_nav" ).slideToggle( "slow");
  $("#mobile_nav").css({
    'position' : 'fixed',
    'top' : '0',
    'width' : '100%',
    'box-sizing' : 'border-box'
  });
});
