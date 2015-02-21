/***************************************************
			jCarousel
***************************************************/
jQuery.noConflict()(function($){
var $zcarousel = $('#crumble_carousel');

    if( $zcarousel.length ) {

        var scrollCount;
        var itemWidth;

        if( $(window).width() < 479 ) {
           		scrollCount = 1;
            	itemWidth = 300;
        	} else if( $(window).width() < 768 ) {
            	scrollCount = 2;
            	itemWidth = 200;
        	} else if( $(window).width() < 960 ) {
            	scrollCount = 3;
            	itemWidth = 172;
        	} else {
            	scrollCount = 4;
            	itemWidth = 230;
        }

        $zcarousel.jcarousel({
               scroll    : scrollCount,
               setupCallback: function(carousel) {
               carousel.reload();
                },
                reloadCallback: function(carousel) {
                    var num = Math.floor(carousel.clipping() / itemWidth);
                    carousel.options.scroll = num;
                    carousel.options.visible = num;
                }
            });
        }
});


/***************************************************
			jCarousel
***************************************************/
jQuery.noConflict()(function($){

	$('#content_masonry').masonry();

$(window).resize(function() {
var 
	$content_masonry = $('#content_masonry');
	$masonry_box = $('#content_masonry .masonry_box');


        if( $(window).width() > 959 ) {               
			$content_masonry.css({ 'width' : '680px' } );	
			$masonry_box.css({ 'width' : '290px' });	
		} 

        if( ($(window).width() > 768) && ($(window).width() < 959)) {               
			$content_masonry.css({ 'width' : '600px' } );	
			$masonry_box.css({ 'width' : '225px' });	
		} 

        if( ($(window).width() > 479) && ($(window).width() <= 768)) {               
			$content_masonry.css({ 'width' : '600px' } );	
			$masonry_box.css({ 'width' : '400px' });	
		} 

		 if( ($(window).width() <= 479)) {               
			$content_masonry.css({ 'width' : '300px' } );	
			$masonry_box.css({ 'width' : '280px' });	
		} 
		

   $('#content_masonry').masonry('reload');
   });
});

