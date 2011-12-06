<?php
/* Client Tracker
**
** (c) 2010-2011 TheScripters.com
**********************************/

require "common.php";

$client = New client();

$account = New accounts();

$head->header_inc($title,"Index");

if ($users->logged_in() === false) {
  include "includes/login.inc.php";
} else {
  if ($_SESSION['clientId'] == 0) {
    $user = "Admin";
  } else {
    $user = $users->user_name($_SESSION['clientId']);
  }
  echo "Welcome, ".$user."!";
  echo "&nbsp;<a href=\"login.php?mode=logout\">Log out</a>";
}

// Add a new client (uncomment to test)
//$newClient = $client->newClient('John Smith','john.smith@mail.com','0');

// Edit Client Info (uncomment both lines to test)
//$data = $client->gatherData(1,'John Smith','john.smith@mail.com','','Phoenix','Arizona','0','0');
//$client->editClient(1,$data);

// View a client by name
//$viewClient = $client->viewClientByName('John Smith');

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