<footer>
    <div class="inner-wrapper">
        <div class="col1">
            <a class="logo-footer" href="index.php">Mustafa Zia Home Page</a>
            <a class="logo-remax" target="_blank" href="http://www.remax.ca/">Remax.ca</a>
        </div>
        <ul class="col2">
            <li><a href="index.php">Home Page</a></li>
            <li><a href="featured_listings.php">Browse our Featured Listings</a></li>
            <li><a href="#TODO">Search Properties on the Map</a></li>
            <li><a href="market_update.php">Market Update</a></li>
            <li><a href="about.php">About Mustafa Zia</a></li>
            <li><a href="#TODO">Home value estimator</a></li>
            <li><a href="calculator.php">Mortgage Calculator</a></li>
            <li><a href="selling_a_home.php">Selling with Mustafa Zia</a></li>
        </ul>
        <ul class="col3">
            <li><a href="investing_real_estate.php">Investing in Real Estate</a></li>
            <li><a href="featured_listings.php#condos">Toronto Condo Listings</a></li>
            <li><a href="featured_listings.php#mississauga">Mississauga Listings</a></li>
            <li><a href="buying_a_home.php">Buy a House in Mississauga</a></li>
            <li><a href="selling_a_home.php">Sell a House in Mississauga</a></li>
            <li><a href="featured_listings.php#milton">Milton Listings</a></li>
            <li><a href="featured_listings.php#oakvile">Oakville Listings</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>                    
        <p>© 2015 MustafaZia.com - All Rights Reserved.<br>
        Not intended to solicit properties currently listed for sale<br>
        * Awarded by Remax Realty One Inc., Brokerage for outstanding sales achievement for years 2009/2010/2011, Remax Legacy/Remax Real Estate Centre for 2012/2013/2014<br>
        ** Based on closed deals by Mustafa Zia within Remax Realty One Inc., Brokerage (independently owned and operated) in 2011/2012 and Remax Legacy Realty Inc., Brokerage Dundas Office 2013. Remax Legacy/Remax Real Estate Centre 2014.
        Platinum award received for 2009 /2010. Chairman’s award received for 2011/2012/2013.  Diamond award 2014. Hall of Fame award received for total commission earned in the years 2009, 2010, 2011.
        #1 Agent based on closed deals with Remax Real Estate Centre 2014 (independently owned and operated). All awards are individual.<br>
        Mustafa Zia does not guarantee the accuracy of any information available on this site, and is not responsible for any errors, omissions, or misrepresentations.<br>
        WebDesign by <a target="_blank" href="http://kauhaus.ca">&lt;&gt; kauhaus</a>.</p>
    </div>
</footer>

<!-- #TODO Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<!-- CHECK IF USER IS AUTHENTICATED AND INITIALIZE WYSIWYG EDITOR -->
<?php if (WebSecurity::isAuthenticated($mysqli)): ?>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="content/js/textboxio.js"></script> 
    <script src="<?php echo SITE_ROOT ?>secure/content/js/spin.min.js"></script>
    <script src="<?php echo SITE_ROOT ?>secure/content/js/ladda.min.js"></script>
    <?php 
        echo('<script>var SITE_ROOT = "'. SITE_ROOT .'";</script>'); 
    ?>
    <script src="<?php echo(SITE_ROOT . 'secure/content/js/main.js') ?>"></script> 
    <script>
        re.views.secure.cms.init();
    </script>
<?php endif; ?>