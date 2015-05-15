<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mustafa Zia - Top Producer Realtor serving  Mississauga, Brampton, Milton, Oakville and Toronto.</title>
        <meta name="description" content="Mustafa Zia is an award wining, top producer realtor serving Mississauga, Brampton, Milton, Oakville and Toronto. Mustafa helps people buying or selling a home, investing in real estate or simply providing helpful advice on real estate matters.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:type"  content="website" />
        <meta property="og:url"   content="http://mustafazia.com/" />
        <meta property="og:title" content="Mustafa Zia | Top Producer Realtor" />
        <meta property="og:image" content="http://mustafazia.com/img/facebook.jpg" />
        <meta property="og:description" content="Mustafa Zia is an award wining, top producer realtor serving Mississauga, Brampton, Milton, Oakville and Toronto. Mustafa helps people buying or selling a home, investing in real estate or simply providing helpful advice on real estate matters." />        

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <link rel="stylesheet" href="css/home.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body id="Index-Page">

        <?php include 'header.php';?>

        <section id="HomeIntro">

            <video autoplay poster="img/vid-poster.jpg" id="HomeBGVideo">
                <source src="vid/video.mp4" type="video/mp4">
                <source src="vid/video.ogv" type="video/ogg">
            </video>

            <div class="blind"></div>

            <div class="inner-wrapper">
                <div class="cms-content" data-nodename="HomeIntro">
                   <?php CMSUtility::ContentLiteral("HomeIntro"); ?>
                </div>
            </div>            
        </section>

        <div class="call-bar">
            <div class="cms-content" data-nodename="HomePhonenumber">
                <?php CMSUtility::ContentLiteral("HomePhonenumber"); ?>
            </div>
        </div>

        <section id="HomeCtas">
            <div class="inner-wrapper cms-content" data-nodename="HomeCtas">
                <?php CMSUtility::ContentLiteral("HomeCtas"); ?>
            </div>
        </section>

        <section id="HomeAbout">
            <div class="inner-wrapper clearfix">
                <div class="left">
                    <div class="cms-content" data-nodename="HomeAbout">
                        <?php CMSUtility::ContentLiteral("HomeAbout"); ?>
                        <img src="img/awards.png" alt="Mustafa's Awards">
                    </div>
                </div>
                <div class="right">
                    <img src="img/mustafa-pic.png" alt="Mustafa Zia Photo">
                </div>
            </div>
        </section>

        <?php include 'footer.php';?>

        <script src="js/vendor/jquery.smooth-scroll.min.js"></script>
        <script src="js/vendor/waypoints.min.js"></script>
        <script src="js/main.js"></script>

        <script>
            $(document).ready(function() { mustafazia.homePage.init(); });            
        </script>
    </body>
</html>
