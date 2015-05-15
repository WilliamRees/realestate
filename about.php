<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mustafa Zia | About</title>
        <meta name="description" content="Mustafa Zia is an award wining, top producer realtor serving Mississauga, Brampton, Milton, Oakville and Toronto. Mustafa helps people buying or selling a home, investing in real estate or simply providing helpful advice on real estate matters.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:type"  content="website" />
        <meta property="og:url"   content="<?php echo "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI]; ?>" />
        <meta property="og:title" content="About Mustafa Zia" />
        <meta property="og:image" content="http://mustafazia.com/img/facebook.jpg" />
        <meta property="og:description" content="Mustafa Zia is an award wining, top producer realtor serving Mississauga, Brampton, Milton, Oakville and Toronto. Mustafa helps people buying or selling a home, investing in real estate or simply providing helpful advice on real estate matters." />        

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <link rel="stylesheet" href="css/basic_page.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>     
    </head>
    <body id="About-Page" class="basic-page">

        <?php include 'header.php';?>

        <div id="TopBanner">
            <div class="inner-wrapper">
                <div class="cms-content" data-nodename="AboutHeadline">
                    <?php CMSUtility::ContentLiteral("AboutHeadline"); ?>
                </div>
            </div>
            <div class="blind"></div>
        </div>

        <section id="ContentBody">
            <div class="inner-wrapper">
                <div class="cms-content" data-nodename="AboutBody">
                    <?php CMSUtility::ContentLiteral("AboutBody"); ?>
                </div>
            </div>            
        </section>

        <section id="About-Testimonials">
            <div class="inner-wrapper">
                <div class="cms-content" data-nodename="AboutTestimonials">
                    <?php CMSUtility::ContentLiteral("AboutTestimonials"); ?>
                </div>            
            </div>
        </section>        
         
        <?php include 'footer.php';?>

        <script src="js/vendor/readmore.js"></script>
        <script src="js/main.js"></script>
        

        <script type="text/javascript">
            $(document).ready(function() { mustafazia.about.init(); });
        </script>

    </body>
</html>
