<footer>
    <div class="inner-wrapper">
        <div class="col1">
            <a class="logo-footer" href="index.php">Mustafa Zia Home Page</a>
            <a class="logo-remax" target="_blank" href="http://www.remax.ca/">Remax.ca</a>
        </div>
        <ul class="col2">
            <li><a href="index.php">Home Page</a></li>
            <li><a href="featured_listings.php">Browse our Featured Listings</a></li>
            <li><a href="http://search.mustafazia.com/" target="_blank">Search Properties on the Map</a></li>
            <li><a href="market_update.php">Market Update</a></li>
            <li><a href="about.php">About Mustafa Zia</a></li>
            <li><a href="http://search.mustafazia.com/images/landing/homeworth/index.asp" target="_blank">Home value estimator</a></li>
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63023856-1', 'auto');
  ga('send', 'pageview');

</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1006084198;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1006084198/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


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