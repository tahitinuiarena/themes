
jQuery.noConflict()(function($){
	$(document).ready(function() {

	$('a[data-rel]').each(function() {
	    $(this).attr('rel', $(this).data('rel'));
	});		

		$("a[rel^='prettyPhoto']").prettyPhoto({
			animationSpeed: 'normal', /* fast/slow/normal */
			opacity: 0.80, /* Value between 0 and 1 */
			showTitle: true, /* true/false */
			theme:'dark_square'
		});
		
		
	});
});

jQuery.noConflict()(function($){
	$(document).ready(function() {
		
			// Create the dropdown bases
			$("<select />").appendTo(".navigation");
				
			// Create default option "Go to..."
			$("<option />", {
			   "selected": "selected",
			   "value"   : "",
			   "text"    : "Go to..."
			}).appendTo(".navigation select");
				
				
			// Populate dropdowns with the first menu items
			$(".navigation li a").each(function() {
			 	var el = $(this);
			 	$("<option />", {
			     	"value"   : el.attr("href"),
			    	"text"    : el.text()
			 	}).appendTo(".navigation select");
			});
			
			//make responsive dropdown menu actually work			
	      	$(".navigation select").change(function() {
	        	window.location = $(this).find("option:selected").val();
	      	});
	      	
//	      	$('#menu div select').remove();
		});
		});
		
		/***************************************************
			SuperFish Menu
***************************************************/	
// initialise plugins
	jQuery.noConflict()(function(){
		jQuery('ul.sf-menu').superfish({
			delay:300,
			speed: 'fast',
			animation:   {height:'show'}			
		});
		

	});





jQuery.noConflict()(function($){
	$(document).ready(function() {
		
		  $('p:empty').remove();
		  
	   	  $('h2.widgettitle').remove();			
		  $('.related-posts-single li:nth-child(4)').css('margin-right' , '0px'); 


	});
});





/*******************************
			COLLAPSE
********************************/
jQuery.noConflict()(function($){
	$(document).ready(function() {
		$(".collapse-crumble").collapse({show: function(){
                    this.animate({
                        opacity: 'toggle', 
                        height: 'toggle'
                    }, 300);
                },
                hide : function() {
                    
                    this.animate({
                        opacity: 'toggle', 
                        height: 'toggle'
                    }, 300);
                }
		         });
         });
    });

