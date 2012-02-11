<?php
session_start();

define('DB_READY',true);

require "includes/db.php";

require "config.php";

require "includes/header_footer.php";

require "includes/clients.php";
require "includes/accounts.php";
require "includes/session.php";

$users = new sessionHandler();

$time = time() - 1860;
$updates = $mdb2->query("DELETE FROM clients_sessions WHERE time < '".$time."'");

?>