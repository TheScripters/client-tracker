<?php
/*
** register.php
** 
** Uses reCaptcha
**
*/

require_once("common.php");

require_once("includes/recaptchalib.php");

// Get reCAPTCHA public key from database
$query = $mdb2->query("SELECT value FROM client_config WHERE id = 'recaptcha_public'");
$rPublic = $query->fetchOne();

if (PEAR::isError($query)) {
  die($mdb2->getMessage());
}

if (!isset($_GET['mode']) || $_GET['mode'] != "verify") {
  $head->header_inc($title,"Register");

  //if ($users->logged_in() === false) {
    include "includes/register.inc.php";
  /*} else {
    header("Location: index.php");
  }*/

} elseif (isset($_GET['mode']) && $_GET['mode'] == "verify") {
  // To be moved to section after registration form is submitted.
  // Get reCAPTCHA private key from database
  $query = $mdb2->query("SELECT value FROM client_config WHERE id = 'recaptcha_private'");
  $rPrivate = $query->fetchOne();

  if (PEAR::isError($query)) {
    die($mdb2->getMessage());
  }
  
  $resp = recaptcha_check_answer ($rPrivate, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
  
  if (!$resp->is_valid) {
    include "includes/register.inc.php";
  } else {
  
  }

}
$head->footer_inc();
?>