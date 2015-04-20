<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mustafa Zia | Home Page</title>
        <meta name="description" content="#TODO">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="css/home.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body id="Index-Page">

        <?php include 'header.php';?>

        <section id="HomeIntro">

            <video autoplay loop poster="vid/video_home_bg.jpg" id="HomeBGVideo">
                <source src="vid/040472783-inside-luxury-office-building-.mp4" type="video/mp4">
                <source src="vid/home.ogv" type="video/ogg">
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
                    </div>
                    <img src="img/awards.png" alt="Mustafa's Awards">
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
