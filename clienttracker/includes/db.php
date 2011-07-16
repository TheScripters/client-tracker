<?php
// Client Database
// (c) 2010 TheScripters.com
error_reporting(E_ALL);

if (!defined('DB_READY')) {
  header("HTTP/1.1 404 NOT Found");
  die("File Not Found");
  exit;
}

// This uses PEAR MDB2 for Database Abstraction
require_once("MDB2.php");

// Database connection info
$config['db']['name'] = "";
$config['db']['pass'] = "";
$config['db']['user'] = "";
$config['db']['server'] = "localhost";
$config['db']['type'] = "mysql";

// Connection string
$dsn = $config['db']['type']."://".$config['db']['user'].":".$config['db']['pass'];
$dsn .= "@".$config['db']['server']."/".$config['db']['name'];

// Globalize mdb2
global $mdb2;

// Connect/check for errors
$mdb2 =& MDB2::connect($dsn);
if (PEAR::isError($mdb2)) {
  die($mdb2->getMessage());
}

$mdb2->setFetchMode(MDB2_FETCHMODE_ASSOC);

// Check to see if configured to force SSL
// and redirect as needed
$mdb2->loadModule("Extended");
$query = $mdb2->query("SELECT value FROM client_config WHERE id = 'ssl'");
$ssl = $query->fetchOne();
if (!PEAR::isError($query)) {
  if ($ssl == "yes") {
    if (!isset($_SERVER['HTTPS'])) {
      header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    }
  } elseif ($ssl == "no") {
    if ($_SERVER['HTTPS'] == "on") {
      header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    }
  }
  unset($ssl);
} else {
  die($query->getMessage());
}

// Disconnect from database
$mdb2->disconnect();
?>