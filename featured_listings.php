<?php
    include_once 'includes/WebSecurity.php';
    include_once 'includes/config.php';
    include_once 'includes/listing.php';
    require_once("includes/CMSUtility.php");
    WebSecurity::sec_session_start();

    $page = (isset($_GET['page']) ? $_GET['page'] - 1 : 0);
    $pageSize = 6;
    $listings = Listing::getListings(($page * $pageSize), $pageSize, true);
    $totalListings = Listing::count(true);

    $featuredListings = Listing::getFeaturedListings();

    $_SESSION['LastPage'] = $page + 1;
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mustafa Zia | Featured Listings</title>
        <meta name="description" content="Listings of houses and condos for sale and for lease in Mississauga, Brampton, Milton, Oakville and Toronto.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:type"  content="website" />
        <meta property="og:url"   content="<?php echo "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" />
        <meta property="og:title" content="Mustafa Zia | Featured Listings" />
        <meta property="og:image" content="http://mustafazia.com/img/facebook.jpg" />
        <meta property="og:description" content="Browse listings of houses and condos for sale and for lease in Mississauga, Brampton, Milton, Oakville and Toronto." />        

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <link rel="stylesheet" href="css/featured_listings.css?v=123">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body id="FeatList-Page">

        <?php include 'header.php';?>

        <section id="FeatList-Carousel" class="owl-carousel">
            <?php
            for ($i = 0; $i < count($featuredListings); $i++) {
                $featuredListing = $featuredListings[$i];
            ?>
            <div class="item">
                <div class="bg-feature" style="background-image: url('<?php echo(SITE_ROOT . "uploads/" . $featuredListing->FeaturedImage) ?>');">
                <div class="blind">
                    <h3><?php echo $featuredListing->Address ?></h3>
                    <p><?php echo $featuredListing->ShortDescription ?></p>
                    <a href="<?php echo SITE_ROOT . "list.php?Id=" . $featuredListing->Id ?>" class="btn">See More Information</a>
                </div>
                </div>
            </div>
            <?php } ?>
        </section>

        <div class="call-bar">
            <p>Call Now: <a href="tel:+16478922474">647 892 2474</a></p>
        </div>

        <?php if (isset($_GET["status"]) && $_GET["status"] == "removed"): ?>
            <div id="StatusMessage">
                The listing you looking for is no longer available, please check our current listings below:
            </div>
        <?php endif; ?>  

        <section id="FeatList-Listings">
            <div class="inner-wrapper">
                <h2>Featured opportunities you might love</h2>
                <?php if ($totalListings/$pageSize > 1): ?>
                <ul class="pagination top">
                    <?php
                    for ($i = 0; $i < ($totalListings/$pageSize); $i++) {
                        $listing = $listings[$i];
                    ?>
                        <li><a class="<?php echo(($page == $i) ? "active" : ""); ?>" href="<?php echo(SITE_ROOT . 'featured_listings.php?page=' . ($i + 1) . "#FeatList-Listings"); ?>"><?php echo($i + 1); ?></a></li>
                    <?php
                    } 
                    ?>
                    <li><a href="<?php echo SITE_ROOT . 'featured_listings.php?page=' . ($i) . "#FeatList-Listings" ?>">></a></li>
                </ul>
                <?php endif; ?>



                <ul class="listings">
                    <?php
                    for ($i = 0; $i < sizeOf($listings); $i++) {
                        $listing = $listings[$i];
                        $new = (date("Y-m-d", strtotime($listing->PublishedDate. ' + 5 days')) > date("Y-m-d")) ? ($listing->Sold == true) ? false : true : false;
                    ?>
                    <li class="<?php echo($new ? "new" : ""); ?>">
                        <a href="<?php echo SITE_ROOT . "list.php?Id=" . $listing->Id ?>">
                            <?php if ($listing->Sold): ?>
                            <span class="sold-sign">SOLD</span>
                            <?php endif; ?>    
                            <?php if (count($listing->Images) == 0): ?>
                                <img src="<?php echo(SITE_ROOT . "/img/image_not_avail.jpg") ?>" alt="Picture for <?php echo($listing->Address) ?>, <?php echo($listing->City) ?>">
                            <?php endif; ?>   
                            <?php if (count($listing->Images) > 0): ?>
                            <img src="<?php echo(SITE_ROOT . "uploads/" . $listing->Images[0]) ?>" alt="Picture for <?php echo($listing->Address) ?>, <?php echo($listing->City) ?>">
                            <?php endif; ?> 

                        </a>
                        <p class="price">$<?php echo $listing->Price  ?></p>
                        <h4><?php echo($listing->Address) ?>, <?php echo($listing->City) ?></h4>
                        <p>
                            <?php echo($listing->Bedrooms == "" ? "" : $listing->Bedrooms . " bed /") ?>
                            <?php echo($listing->Bathrooms == 0 ? "" : $listing->Bathrooms . " bath")  ?>
                        </p>                        
                    </li>                                                      
                    <?php
                    } 
                    ?>
                </ul>

                <?php if ($totalListings/$pageSize > 1): ?>
                <ul class="pagination bottom">
                    <?php
                    for ($i = 0; $i < ($totalListings/$pageSize); $i++) {
                        $listing = $listings[$i];
                    ?>
                        <li><a class="<?php echo(($page == $i) ? "active" : ""); ?>" href="<?php echo(SITE_ROOT . 'featured_listings.php?page=' . ($i + 1) . "#FeatList-Listings"); ?>"><?php echo($i + 1); ?></a></li>
                    <?php
                    } 
                    ?>
                    <li><a href="<?php echo SITE_ROOT . 'featured_listings.php?page=' . ($i) . "#FeatList-Listings" ?>">></a></li>
                </ul>
                <?php endif; ?>

            </div>
        </section>

        <div class="call-bar">
            <p>Call Now: <a href="tel:+16478922474">647 892 2474</a></p>
        </div>        
        
        <?php include 'footer.php';?>

        <script src="js/vendor/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>

        <script type="text/javascript">
            $(document).ready(function() { mustafazia.featuredListings.init(); });
        </script>
    </body>
</html>
