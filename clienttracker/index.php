<?php
// (c) 2010 TheScripters.com

require "common.php";

$client = New client();

$account = New accounts();

$head->header_inc($title,"Index");

if (!$users->logged_in()) {
  include "includes/login.inc.php";
} else {
  if ($_SESSION['clientId'] == 0) {
    $user = "Admin";
  } else {
    $user = $users->user_name($_SESSION['clientId']);
  }
  echo "Welcome, ".$user."!";
}

// Add a new client (uncomment to test)
//$newClient = $client->newClient('GCNA','webmaster@gcna.info','0');

// Edit Client Info (uncomment both lines to test)
//$data = $client->gatherData(6,'GCNA','webmaster@gcna.info','','Phoenix','Arizona','0','0');
//$client->editClient(6,$data);

// View a client by name
//$viewClient = $client->viewClientByName('Daniel Champagne');

//echo "<pre>";
//print_r($viewClient);
//echo "</pre>";

//$actInfo = $account->accountInfo($viewClient['clientid']);

//echo "<pre>";
//print_r($actInfo);
//echo "</pre>";

// View all clients
//$allClients = $client->allClients();

//echo "<pre>";
//print_r($allClients);
//echo "</pre>";

$head->footer_inc();
?>