<?php
/**
 * These are the database login details
 */  
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "rewebuser");    // The database username. 
define("PASSWORD", "rewebuser");    // The database password. 
define("DATABASE", "RealEstate");    // The database name.
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!

/**
* PATHS 
*/
define("SITE_ROOT", "http://172.16.102.129/DevBox/mustafa-backend/");
//define("SITE_ROOT", "http://172.16.158.129/VMLamp/real-estate/");
define("LOGIN_SUCCESS", SITE_ROOT . "secure/listing/");
define("LOGIN_ERROR", SITE_ROOT . "secure/login/index.php?error");
define("ERROR", SITE_ROOT . "error.php");

?>