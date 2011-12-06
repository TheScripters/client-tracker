<?php
// login.php

require("common.php");

// Check if already logged in...
if ($users->logged_in() === false && !isset($_GET['mode'])) {
  // Not logged in, and not attempting to log in,
  // display log in form for username/password
  $head->header_inc($title,"Login");
  
  include "includes/login.inc.php";
  
  $head->footer_inc();
  
  // Check if logging in...
} elseif ($users->logged_in() === false && $_GET['mode'] == "login") {
  // Set variables and redirect to index.php
  if (!empty($_REQUEST['uname']) && !empty($_REQUEST['pw'])) {
    if ($_REQUEST['uname'] != "admin") {
      $query = $mdb2->query("SELECT clientId,clientPassword FROM clients_info WHERE clientUserName = '".$_REQUEST['uname']."'");
      $user = $query->fetchRow();
      $t_hasher = new PasswordHash(8, FALSE);
      $hash = $user['clientPassword']; //from database
      $check = $t_hasher->CheckPassword($_REQUEST['pw'], $hash);
      //$check will be true or false if the passwords match
      if ($check === true) {
        $users->log_in();
        $_SESSION['logged_in'] = "true";
        $_SESSION['clientId'] = $user['clientId'];
        header("Location: index.php");
      }
    } else {
      $query = $mdb2->query("SELECT value AS admin_pw FROM client_config WHERE id = 'admin_password'");
      $user = $query->fetchOne();
      $t_hasher = new PasswordHash(8, FALSE);
      $hash = $user['admin_pw']; //from database
      $check = $t_hasher->CheckPassword($_REQUEST['pw'], $hash);
      //$check will be true or false if the passwords match
      if ($check === true) {
        $users->log_in();
        $_SESSION['logged_in'] = "true";
        $_SESSION['clientId'] = 0;
        header("Location: index.php");
      }
    }
  }
  
} elseif ($users->logged_in() === true && $_GET['mode'] == "logout") {
  // Unset variables and redirect to index.php
  $users->logout();
  header("Location: index.php");
  
  // If no other combinations match, redirect to index.php
} else {
  header("Location: index.php");
}

?>