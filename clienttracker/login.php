<?php
// login.php

require("common.php");

// Check if already logged in...
if (!isset($_SESSION['logged_in']) && !isset($_GET['mode'])) {
  // Not logged in, and not attempting to log in,
  // display log in form for username/password
  $head->header_inc($title,"Login");
  
  
  
  $head->footer_inc();
  
  // Check if logging in...
} elseif (!isset($_SESSION['logged_in']) && $_GET['mode'] == "login") {
  // Set variables and redirect to index.php
  
  
} elseif ($_SESSION['logged_in'] == "true" && $_GET['mode'] == "logout") {
  // Unset variables and redirect to index.php
  unset($_SESSION);
  header("Location: index.php");
  
  // If no other combinations match, redirect to index.php
} else {
  header("Location: index.php");
}

?>