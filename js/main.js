window.mustafazia = window.mustafazia || {};

mustafazia.shared = {
    init : function () {
		// Mobile Menu
        $(".mobile-menu").click(function (e) {
            e.preventDefault();
            $("header nav").toggleClass("on");
        });

    },  
    formLabels : function() {
        $( "form input[type=text], form input[type=email], form textarea" ).focusin(function() {
            $(this).parent().find("label").addClass("focus-on");
        });
        $( "form input[type=text], form input[type=email], form textarea" ).focusout(function() {
            if ($(this).val() === "") {
                $(this).parent().find("label").removeClass("focus-on");
            }       
        });
        $("form input[type=text], form input[type=email], form textarea").each(function(){
            if($.trim($(this).val())){
                $(this).parent().find("label").addClass("focus-on");
            }
        });
    },
    owlKeyTriggers : function (owl) {
        $(document).keydown(function(e) {
            switch(e.which) {
                case 37: // left
                    owl.trigger('prev.owl.carousel');
                    break;

                case 39: // right
                    owl.trigger('next.owl.carousel');
                break;
                default: return; // exit this handler for other keys
            }
            e.preventDefault(); // prevent the default action (scroll / move caret)
        });
    },
    googleMaps : function () {

        var mapProceed = false;

        if (typeof listing_lat !== 'undefined') {
            if (typeof listing_lat === 'number') {
                if (typeof listing_lng !== 'undefined') {
                    if (typeof listing_lng === 'number') {
                        mapProceed = true;
                    }
                }  
            }
        }        

        if (!mapProceed) { 
            $("#Map").hide();
            return false;
        }

        var mapStyle = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];

        function initialize() {
            var MY_MAPTYPE_1 = '';
            var myLatlng = new google.maps.LatLng(listing_lat, listing_lng);
            var map_canvas = document.getElementById('Map');
            var map_options = {
              center: myLatlng,
              zoom: 16,
              scrollwheel: false,
              mapTypeId: MY_MAPTYPE_1
            }
            var map = new google.maps.Map(map_canvas, map_options)
            var customMapType1 = new google.maps.StyledMapType(mapStyle);
            map.mapTypes.set(MY_MAPTYPE_1, customMapType1);

            var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              animation: google.maps.Animation.DROP,
              title: 'Address',
              icon: 'img/marker.png'
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);

    },
    sendEmail: function () {
        var proceed = true;
        $("form input[data-required=true], form textarea[data-required=true]").each(function(){
            if(!$.trim($(this).val())){
                $(this).parent("div").addClass("error");
                proceed = false; 
            } else {
                $(this).parent("div").removeClass("error");
            }
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).parent("div").addClass("error"); 
                proceed = false;              
            }   
        });

        $("form input[data-required=true], form textarea[data-required=true]").keyup(function() { 
            $(this).parent("div").removeClass("error");
        });

        if(proceed) {
            post_data = {
                'user_name'     : $('input[name=f-name]').val(), 
                'user_email'    : $('input[name=f-email]').val(), 
                'user_phone'    : $('input[name=f-phone]').val(),
                'prop_id'       : $('input[name=f-propid]').val(),
                'msg'           : $('textarea[name=f-message]').val()
            };
            $.post('email.php', post_data, function(response){  
                if(response.type == 'error'){ //load json data from server and output message     
                    $("#FormError").html(response.text).show();
                } else {
                    $("#FormError").hide();
                    $("#f-send").hide();
                    $("#FormSuccess").html(response.text).show();
                    $("form input[data-required=true], form textarea[data-required=true]").addClass("off").attr("disabled", "disabled");                    
                }
            }, 'json');
        }
    }            
}

mustafazia.homePage = {
    init : function () {

    	// Start Smooth Scroll
        $('#HomeIntro a').smoothScroll();

        // Waypoint Triggers
        mustafazia.homePage.wayPoints();

    },
    wayPoints : function () {

        $('#HomeIntro').waypoint(function() {
            $("#HomeIntro h1").addClass("on");
            $("#HomeIntro .btn").addClass("on");
        },{ triggerOnce: true, offset: 0 });

        $('#HomeCtas').waypoint(function() {
            $(".big-ctas li").addClass("on");
        },{ triggerOnce: true, offset: 450 });

        $('#HomeAbout').waypoint(function() {
            $(".right img").addClass("on");
        },{ triggerOnce: true, offset: 450 });

    }    
}

mustafazia.featuredListings = {
    init : function () {
    	// Init Carousel
        var $owl = $('.owl-carousel');
        $owl.owlCarousel({
            loop:true,
            nav:true,
            dots: true,
            items:1,
            autoplay: true,
            autoplayTimeout: 5000
        });    	
        mustafazia.shared.owlKeyTriggers($owl);
    }   
}

mustafazia.listings = {
    init : function () {

        mustafazia.shared.formLabels();
        mustafazia.listings.syncedOwls();
        mustafazia.shared.googleMaps();

        // bind send button to email forms\
        $("#f-send").click(function(e) {
            e.preventDefault();
            mustafazia.shared.sendEmail();
        });            

    },   

    syncedOwls : function () {

        var $sync1 = $(".owl-carousel1"),
            $sync2 = $(".owl-carousel2"),
            flag = false,
            duration = 300;

        $sync1
            .owlCarousel({
                items: 1,
                margin: 0,
                nav: true,
                dots: false,
                autoplay: true,
                autoHeight: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true
            })
            .on('change.owl.carousel', function (e) {
                if (e.namespace && e.property.name === 'position' && !flag) {
                    flag = true;
                    $sync2.trigger('to.owl.carousel', [e.property.value, duration, true]);
                    flag = false;
                }
            });

        $sync2
            .owlCarousel({
                margin: 10,
                items: 6,
                nav: false,
                autoHeight: true,
                dots: false
            })
            .on('click', '.owl-item', function () {
                $sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);
            })
            .on('change.owl.carousel', function (e) {
                if (e.namespace && e.property.name === 'change' && !flag) {
                    flag = true;        
                    $sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
                    flag = false;
                }
            });

        mustafazia.shared.owlKeyTriggers($sync1);

    }
}

mustafazia.contact = {
    init : function () {
        mustafazia.shared.formLabels();
        mustafazia.shared.googleMaps();

        // bind send button to email form
        $("#f-send").click(function(e) {
            e.preventDefault();
            mustafazia.shared.sendEmail();
        });            
    }   
}

mustafazia.about = {
    init : function () {

        // Iniciate Read More Plugin
        $(".read-more").each(function(index) {
            $(this).readMore({
                size            : 100,                   // container max height when closed
                animation       : true,                 // animate it ?
                gap             : 0,                    // specify a gap between the height and cut of point
                wrapper         : {                     // wrapper options
                    tag       : 'div',
                    css_class : 'read-more-wrapper'
                },
                expand_button   : {                     // expand button caption
                    more      : 'Read more...',
                    less      : 'Show Less',
                    ccs_class : 'read-more-switch'          // class for the switch button
                }
            });
        });

    }
}

$(document).ready(function() { mustafazia.shared.init(); });