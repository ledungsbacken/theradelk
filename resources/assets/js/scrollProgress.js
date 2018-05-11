$(document).ready(function() {
    $(document).scroll(function() {
        var scrollwin = $(window).scrollTop();
        var articleheight = $('#progressMarker').height() - $(window).height();

    if(scrollwin >= $('#progressMarker').offset().top){console.log('true');
        if(scrollwin <= ($('#progressMarker').offset().top + articleheight)){
            $('#progressBar').css('width', ((scrollwin - $('#progressMarker').offset().top) / articleheight) * 100 + "%"  );
        } else {
            $('#progressBar').css('width',"100%");
        }
    }
    else{console.log('nope');
        $('#progressBar').css('width',"0%");
    }
    });
});
