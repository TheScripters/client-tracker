<?php
// (c) 2010 TheScripters.com

require "common.php";

$client = New client();

$account = New accounts();

$head->header_inc($title,"Index");

if (!$users->logged_in()) {
  include "includes/login.inc.php";
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