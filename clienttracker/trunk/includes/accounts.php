<?php
// (c) 2010 TheScripters.com

class accounts {
  public function accountInfo($client) {
    global $mdb2;
    
    $query = $mdb2->query("SELECT * FROM accounts_info WHERE clientId = '".$client."'");
    if (PEAR::isError($query)) {
      die($mdb2->getMessage());
    }
    
    $result = $query->fetchRow();
    
    $query->free();
    
    return $result;
  }
  
  public function accountList($client=0) {
    global $mdb2;
    
    // Code
  }
}

?>