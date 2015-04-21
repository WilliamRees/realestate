/*
 *  @name           Read More Plugin
 *  @authors        Kaue Correa
 *
 */

(function( $ ){
               
	$.fn.readMore = function( option ) {

		// Set defaults
		var defaults = {
	        size			: 40,				// container max height when closed
			animation		: true,			// Code Review: animation is pending for now...
			gap				: 0, 				// specify a gap between the height and cut of point
	        wrapper 		: {					// wrapper options
	            tag   	  : 'div',
	            css_class : 'read-more-wrapper'
	        },
	        expand_button	: {					// expand button caption
	            more 	 : '+',
	            less 	 : '&ndash;',
	            css_class: 'read-more-switch'	// class for the switch button
	        }
		};

        // Write options        
        $.extend(true, defaults, option);

        // Create shorthand for the options
        var size		  = defaults.size;
        var animation 	  = defaults.animation;  
        var gap 	 	  = defaults.gap;      
        var wrapper_tag   = defaults.wrapper.tag;
		var wrapper_class = defaults.wrapper.css_class;
        var expand_more   = defaults.expand_button.more;
        var expand_less   = defaults.expand_button.less;
        var expand_class  = defaults.expand_button.css_class;

        // Capture the dom element to re-use
        var $this = $(this); 

        // Check if data-attr was set and override the options
        var data_size  = $this.attr('data-size');
        var data_class = $this.attr('data-class');
        var data_gap   = $this.attr('data-gap');

        if (data_size) {
        	size = data_size;
        }
        if (data_class) {
        	wrapper_class = data_class;
        }
        if (data_gap) {
        	gap = data_gap;
        }

        // Kill it if the content size is smaller than the desired closed container
        if (($this.height()-gap) <= size) {
        	return false;
        };

        // Set the initial size and overflow
        $this.css('height', 'auto');
        $this.css('overflow', 'hidden');

        // Store original height
        var originalHeight = $this.outerHeight();

        // Initially in collapsed state
        $this.css('height', size);

        // Templates
        var wrapper = "<" + wrapper_tag + " class='" + wrapper_class + "'>";
        var switch_button = "<div class='" + expand_class + " closed'>" + expand_more + "</div>"

        // Setup the wrapper and save the dom element
        $this.wrapAll(wrapper);
        var $wrapper_obj = $this.parent(wrapper_tag);

        // Add the button expand/collapse button
        $wrapper_obj.append(switch_button);

        // method to expand
        var expandContent = function() {
            if (animation) {
                $this.animate({ height: originalHeight }, "fast");
            } else {
                $this.css('height','auto');
            }
        };

        // method to collapse
        var collapseContent = function() {
            if (animation) {
                $this.animate({ height: size }, "fast");
            } else {
                $this.css('height', size);
            }
        };

        // binding the handler
        $wrapper_obj.find("."+expand_class).on("click", function(event){

			if ($(this).hasClass('open')) {

				$(this).removeClass('open')
					   .addClass('closed')
					   .html(expand_more);

				collapseContent();

			} else {

				$(this).removeClass('closed')
					   .addClass('open')
					    .html(expand_less);

				expandContent();

			}
		});
                       
	};
    
})( jQuery );