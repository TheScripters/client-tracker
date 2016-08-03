<?php
// Config.php

$query = $mdb2->query("SELECT value FROM client_config WHERE id = 'title'");
$title = $query->fetchOne();

if (PEAR::isError($query)) {
  die($mdb2->getMessage());
}

?>