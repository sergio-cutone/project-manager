(function($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(function() {
    	if ($('.project-slider').length){

    		var slide = [];
    		var c = 0;

            function checkData(el,dat){
                console.log(dat+": "+el.data(dat)+":"+typeof el.data(dat));
                if (typeof el.data(dat) === 'undefined' || el.data(dat) === 0 || !el.data(dat)) {
                    console.log('f')
                    return false;
                } else {
                    console.log('t')
                    return true;
                }
            }

    		$('.project-slider').each(function(){
    			var ths = $(this);
    			var margin = ths.data("margin") ? parseInt(ths.data("margin")) : 0;
    			var cols = ths.data("cols") ? ths.data("cols") : 1;
    			var auto = checkData(ths,'auto');
    			var width = parseInt(ths.width() / cols);
                var captions = checkData(ths,'captions');
                var dots = checkData(ths,'dots');

	        	slide[c] = {
		            mode: 'horizontal',
		            captions: captions,
		            minSlides: cols,
		            maxSlides: cols,
		            moveslides: cols,
		            auto: auto,
		            shrinkItems: true,
		            slideWidth: width,
		            slideMargin: margin,
		            pager: dots,
		            adaptiveHeight: true,
		            //onSliderLoad: checkH
	        	};
	        	c++;
    		});


    		var sliders = new Array();
    		$('.project-slider').each(function(i, slider) {
        		sliders[i] = $(slider).bxSlider();
    		});

    		function bxInit() {
    		    $.each(sliders, function(i, slider) {
    		    	console.log(slide[i]);
            		slider.destroySlider(slide[i]);
            		slider.reloadSlider(slide[i]);
        		});
           		checkH();
    		}
    		$(window).on("load", function(){
	    		setTimeout(function(){
		    		bxInit();
	    		},100);
    		});

    		$(window).on('resize',function(){
    			$('.project-slider img').css("height","auto");
    			bxInit();
    		});

    		 Array.prototype.min = function() {
  				return Math.min.apply(null, this);
			};
    		function checkH (ths){
    			setTimeout(function(){
	    			$('.project-slider').each(function(){
	    				var h = [];
	    				$('img',$(this)).each(function(){
	    					console.log($(this).outerHeight());
	    					h.push($(this).height());
		   				});
		   				console.log("bah"+h.min());
		   				$('img',$(this)).height(h.min());
	    			});
	    		},500);
    		}

    	}
    });

})(jQuery);