<?php
    include_once 'includes/WebSecurity.php';
    include_once 'includes/config.php';
    include_once 'includes/listing.php';
    require_once("includes/CMSUtility.php");
    WebSecurity::sec_session_start();

    $id = $_GET['Id'];
    $listing = Listing::getListingById($id);

    if ($listing == null) {
        header('Location: ' . SITE_ROOT . "featured_listings.php?status=removed#StatusMessage"); 
    }
    //echo "<pre>";
    //print_r($listing);
    //echo "</pre>";
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $listing->Address ?>, <?php echo $listing->City ?> | Mustafa Zia</title>
        <meta name="description" content="Listing for <?php echo $listing->Address ?>, <?php echo $listing->City ?> | Mustafa Zia">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:type"  content="website" />
        <meta property="og:url"   content="<?php echo "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" />
        <meta property="og:title" content="Mustafa Zia | <?php echo $listing->Address ?>, <?php echo $listing->City ?>" />
        <?php if (count($listing->Images) == 0): ?>
            <meta property="og:image" content="<?php echo SITE_ROOT . "img/image_not_avail.jpg" ?>" />
        <?php endif; ?>   
        <?php if (count($listing->Images) > 0): ?>
            <meta property="og:image" content="<?php echo SITE_ROOT . "uploads/" . $listing->Images[0] ?>" />    
        <?php endif; ?>
        <meta property="og:description" content="Listing for <?php echo $listing->Address ?>, <?php echo $listing->City ?> | Mustafa Zia" />        

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <link rel="stylesheet" href="css/list.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script>
            var listing_lat = <?php echo ($listing->Latitude == 0) ? "undefined" : $listing->Latitude ?>;
            var listing_lng = <?php echo ($listing->Longitude == 0) ? "undefined" : $listing->Longitude ?>;
        </script>      
    </head>
    <body id="List-Page">

        <?php include 'header.php';?>

        <section id="List-Heading">
            <div class="inner-wrapper">
                <a class="back-link" href="featured_listings.php<?php echo(isset($_SESSION['LastPage']) ? "?page=" . $_SESSION['LastPage'] . "#FeatList-Listings" : "" ) ?>">Back to Results</a>

                <h1><?php echo $listing->Address ?>, <?php echo $listing->City ?></h1>
                <h2>$<?php echo( $listing->Price ); ?></h2>            
            </div>
        </section>

        <section id="List-Body">
            <div class="inner-wrapper">
                <div class="left">

                    <div class="owl-carousel1">
                        <?php
                        for ($i = 0; $i < sizeOf($listing->Images); $i++) {
                            $image = $listing->Images[$i];
                        ?>
                        <div class="item">
                            <img src="<?php echo(SITE_ROOT . "uploads/" . $image) ?>" alt="Home Image">
                        </div>                          
                        <?php
                        }
                        ?>
                    </div>

                    <div class="owl-carousel2">
                        <?php
                        for ($i = 0; $i < sizeOf($listing->Images); $i++) {
                            $image = $listing->Images[$i];
                        ?>
                        <div class="item">
                            <img src="<?php echo(SITE_ROOT . "uploads/" . $image) ?>" alt="Thumbnail for Home Image">
                        </div>                          
                        <?php
                        }
                        ?>                         
                    </div>

                    <?php if(isset($listing->VirtualTour) && strlen($listing->VirtualTour) > 0) : ?>
                        <a target="_blank" href="<?php echo($listing->VirtualTour) ?>" class="btn-round btn-vt">Virtual Tour</a>        
                    <?php endif; ?>
                    
                    <a target="_blank" href="calculator.php" class="btn-round btn-mc">Mortgage Calculator</a>

                    <h3>Property Description</h3>

                    <p><?php echo $listing->Description ?></p>
                    
                    <a class="back-link bottom" href="featured_listings.php<?php echo(isset($_SESSION['LastPage']) ? "?page=" . $_SESSION['LastPage'] . "#FeatList-Listings" : "" ) ?>">Back to Results</a>

                </div>
                <div class="right">

                    <div class="listing-info">
                        <p><span>Property Type:</span> <?php echo $listing->PropertyType == "" ? "-" : $listing->PropertyType ?></p>
                        <p><span>Bedrooms:</span> <?php echo $listing->Bedrooms == "" ? "-" : $listing->Bedrooms?></p>
                        <p><span>Bathrooms:</span> <?php echo $listing->Bathrooms == 0 ? "-" : $listing->Bathrooms?></p>
                        <p><span>Living space:</span> <?php echo $listing->LivingSpace == "" ? "-" : $listing->LivingSpace ?> sq. ft</p>
                        <p><span>Lot size:</span> <?php echo $listing->LandSize == 0 ? "-" : $listing->LandSize?></p>
                        <p><span>Tax Year:</span> <?php echo $listing->TaxYear == 0 ? "-" : $listing->TaxYear?></p>
                        <p><span>Taxes:</span> <?php echo($listing->Taxes == 0 ? "-" : "$".number_format($listing->Taxes, 0, '.', ',')); ?></p>
                        <p><span>Age of Building:</span> <?php echo $listing->BuildingAge == "" ? "-" : $listing->BuildingAge?></p>
                    </div>

                    <div id="Map">
                  
                    </div>

                    <div class="form-wrapper">

                        <h4>Contact us</h4>

                        <div id="FormError"></div>
                        <form id="ContactForm">
                            <input type="hidden" name="f-propid" id="f-propid" value="Property: <?php echo $listing->Id ?>">
                            <div>
                                <label for="f-name">Name:*</label>
                                <input data-required="true" type="text" name="f-name" id="f-name">
                                <span>^ you must provide a valid name</span>
                            </div>
                            <div>
                                <label for="f-phone">Phone Number:*</label>
                                <input data-required="true" type="text" name="f-phone" id="f-phone">
                                <span>^ you must provide a valid phone number</span>            
                            </div>                
                            <div>
                                <label for="f-email">E-mail:*</label>
                                <input data-required="true" type="email" name="f-email" id="f-email">
                                <span>^ you must provide a valid email</span>            
                            </div>
                            <div>
                                <label for="f-message">Your Message:*</label>
                                <textarea data-required="true" id="f-message" name="f-message" rows="3" cols="50"></textarea>
                                <span>^ you must enter a valid message</span>
                            </div>
                            <small>* Required Fields</small>
                            <input id="f-send" type="submit" class="btn-round" value="Send">
                            <div id="FormSuccess"></div>
                        </form>
                    </div>
                    <div class="social-share">
                        <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                    </div>
                    <div class="social-share">    
                        <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>                      
                        <div id="fb-root"></div>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                        <div class="fb-like" data-href="<?php echo "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
                    </div>                    
                    
                </div>
            </div>
        </section>
        
        <div class="call-bar">
            <p>Call Now: <a href="tel:+16478922474">647 892 2474</a></p>
        </div>    
        
        <?php include 'footer.php';?>

        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>        
        <script src="js/vendor/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() { mustafazia.listings.init(); });
        </script>

    </body>
</html>
