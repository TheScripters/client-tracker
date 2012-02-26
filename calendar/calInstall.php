<?php
// Database connection info
require_once("calDB.php");

$query = "CREATE TABLE ".$config['db']['name'].".".$config['db']['prefix']."calendar (
    event_id BIGINT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_time BIGINT(11) NOT NULL,
    event_desc VARCHAR(50) NOT NULL,
    user_id BIGINT(12) NOT NULL,
    info_url VARCHAR(255),
    event_info VARCHAR(250),
    INDEX ( event_time , user_id )
  ) ENGINE = MYISAM";

mysql_query($query) or die(print mysql_error());

// Not yet fully implemented
if ($config['standalone'] == "true") {
  $query = "CREATE TABLE ".$config['db']['name'].".".$config['db']['prefix']."users (
    user_id BIGINT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    real_name VARCHAR(80),
    user_role TINYINT(1) NOT NULL
    ) ENGINE=MYISAM";
  mysql_query($query) or die(print mysql_error());
}

print "Calendar successfully installed.";

?>