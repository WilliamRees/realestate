<footer>
    <div class="inner-wrapper">
        <div class="col1">
            <a class="logo-footer" href="index.php">Mustafa Zia Home Page</a>
            <a class="logo-remax" target="_blank" href="http://www.remax.ca/" target="_blank">Remax.ca</a>
        </div>
        <ul class="col2">
            <li><a href="#TODO">Mississauga Real Estate Listings</a></li>
            <li><a href="#TODO">Toronto Condo Listings</a></li>
            <li><a href="#TODO">Mississauga MLS</a></li>
            <li><a href="#TODO">Buy a House in Mississauga</a></li>
            <li><a href="#TODO">Sell a House in Mississauga</a></li>
            <li><a href="#TODO">Milton Realtors</a></li>
            <li><a href="#TODO">Useful Real Estate Resources</a></li>
            <li><a href="#TODO">About Mustafa Zia</a></li>
            <li><a href="#TODO">Contact Us</a></li>
        </ul>
        <ul class="col3">
            <li><a href="#TODO">Mississauga Real Estate Listings</a></li>
            <li><a href="#TODO">Toronto Condo Listings</a></li>
            <li><a href="#TODO">Mississauga MLS</a></li>
            <li><a href="#TODO">Buy a House in Mississauga</a></li>
            <li><a href="#TODO">Sell a House in Mississauga</a></li>
            <li><a href="#TODO">Milton Realtors</a></li>
            <li><a href="#TODO">Useful Real Estate Resources</a></li>
            <li><a href="#TODO">About Mustafa Zia</a></li>
            <li><a href="#TODO">Contact Us</a></li>
        </ul>                    
        <p>©2015 MustafaZia.com   All Rights Reserved.<br>
        Not intended to solicit properties currently listed for sale<br>
        *Based on firm deals by Mustafa Zia within Remax Realty One Inc., Brokerage and Remax Legacy  Inc., Brokerage Dundas Office (independently owned and operated) in 2012.**Awarded by Remax Realty One Inc.,<br>
        Brokerage for outstanding sales achievement for years 2009/2010/2011, Remax Legacy Inc., Brokerage for 2012.  ***Platinum award received for 2009 &amp;2010. Chairman’s award received for 2011 &amp; 2012. Hall of Fame award received for total commission earned in the years 2009, 2010, 2011.  Total worth of Real Estate sold in the years 2009, 2010, 2011, 2012 based on the purchase price. All awards are individual.</p>
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