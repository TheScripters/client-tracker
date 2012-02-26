<?php
// Set default timezone
date_default_timezone_set("America/Denver");

// Database connection info
$config['db']['name'] = "";
$config['db']['pass'] = "";
$config['db']['user'] = "";
$config['db']['server'] = "localhost";

// Set this line to "true" to use as standalone calendar
// Leave as "false" to integrate with phpBB
$config['standalone'] = "false";

// Leave this line uncommented to integrate with phpBB
$config['db']['prefix'] = "phpbb_";

// Uncomment this line if using as standalone system
// (not yet fully operational)
//$config['db']['prefix'] = "cal_";

// Do not edit below this line
$conn = mysql_connect($config['db']['server'],$config['db']['user'],$config['db']['pass']);
mysql_select_db($config['db']['name'],$conn);
?>