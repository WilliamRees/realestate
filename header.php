<!-- Includes -->
<?php
    include_once 'includes/WebSecurity.php';
    include_once 'includes/config.php';
    require_once("includes/CMSUtility.php");
    WebSecurity::sec_session_start();
?>
<?php if (WebSecurity::isAuthenticated($mysqli)): ?>
    <style>
        .admin {
            padding: 15px 0; 
            background-color: rgba(248, 248, 248, 0.5);
            position: fixed; 
            z-index: 3000; 
            width:100%; 
            border-bottom: 1px solid #e7e7e7; 
        }
        .admin .btn {
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
            float:right;
            margin-right: 20px;
        }
        .ephox-polish-editor-container {
            z-index:3001;
        }
        .ephox-candy-mountain * {
            transform: none !important;
            opacity: 1 !important;
            position: relative;
            z-index: 3002;
        }
    </style>
    <div class="admin">
        <a href="#" class="btn" id="SaveContentChanges">Save</a>
    </div>
<?php endif; ?>
<header>
    <a class="logo" href="#TODO">Home</a>
    <nav>
        <ul>
            <li><a class="home-link" href="index.php">Home</a></li>
            <li><a class="feature-link" href="featured_listings.php">Featured Listings</a></li>
            <li><a class="search-link" href="#TODO">Search Properties</a></li>
            <li><a class="market-link" href="market_update.php">Market Update</a></li>
            <li><a class="about-link" href="#TODO">About</a></li>
            <li><a class="contact-link" href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>