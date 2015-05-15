<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mustafa Zia | About</title>
        <meta name="description" content="#TODO">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
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
