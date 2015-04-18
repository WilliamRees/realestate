<?php phpinfo(); ?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>#TODO</title>
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
                <h1>Top Producer<br>5 years in a row</h1>
                <a href="#HomeCtas" class="btn">See what Mustafa Zia can do for you</a>
                <a href="#HomeCtas" class="see-more">See More</a>
            </div>
            
        </section>

        <div class="call-bar">
            <p>Call Now: <a href="tel:+16478922474">647 892 2474</a></p>
        </div>

        <section id="HomeCtas">
            <div class="inner-wrapper">
                <ul class="big-ctas">
                    <li class="cta1"><a href="#TODO"><span></span>Featured Listings</a></li>
                    <li class="cta2"><a href="#TODO"><span></span>Search Properties</a></li>
                    <li class="cta3"><a href="#TODO"><span></span>Living in the GTA</a></li>
                    <li class="cta4"><a href="#TODO"><span></span>What is your Home Worth?</a></li>
                    <li class="cta5"><a href="#TODO"><span></span>Mortgage Calculator</a></li>
                </ul>
                <h3>Additional Resources</h3>
                <ul class="small-ctas">
                    <li><a href="#TODO">Buying a Home</a></li>
                    <li class="dot">.</li>
                    <li><a href="#TODO">Selling a Home</a></li>
                    <li class="dot">.</li>
                    <li><a href="#TODO">Investing in Real Estate</a></li>
                </ul>
            </div>
        </section>

        <section id="HomeAbout">
            <div class="inner-wrapper clearfix">
                <div class="left">
                    <h2>About Mustafa Zia</h2>
                    <p>This is a placeholder text, Mustafa graduated from University of Toronto with an Honors Joint Specialist Degree in Economics and Political Science. <br>
                    This is a placeholder text, Mustafa graduated from University of Toronto with an Honors Joint Specialist Degree in Economics and Political Science.</p>
                    <a class="btn" href="#TODO">Get to know Mustafa Zia</a>
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
