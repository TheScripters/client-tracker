<?php
// (c) 2010 TheScripters.com

class headerFooter {
  function header_inc($site,$page) {
    $title = $site . " :: " . $page;
    include "includes/header.inc";
  }

  function footer_inc() {
    include "includes/footer.inc";
  }
}

$head = New headerFooter();
?>