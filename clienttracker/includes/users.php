<?php
// users.php

class users {
  
  public function logged_in() {
    global $mdb2;
    
    $sessionId = $this->sessionId();
    
    $query = $mdb2->query("SELECT COUNT(*) AS count FROM clients_sessions WHERE sessionId = '".$sessionId."'");
    $validSessId = $query->fetchOne();
    
    if ($validSessId == 1) {
      $query = $mdb2->query("SELECT time,ipAddress,data FROM clients_sessions WHERE sessionId = '".$sessionId."'");
      $sessTime = $query->fetchRow();
      $now = time();
      if (($now-$sessTime['time']) <= 1800 && $sessTime['ipAddress'] == $_SERVER['REMOTE_ADDR']) {
        $update = $mdb2->query("UPDATE clients_sessions SET time = '".time()."' WHERE sessionId = '".$sessionId."'");
        if ($sessTime['data'] = "logged_in") {
          return true;
        } else {
          $query = $mdb2->query("DELETE FROM clients_sessions WHERE sessionId = '".$sessionId."'");
          return false;
        }
      } else {
        $query = $mdb2->query("DELETE FROM clients_sessions WHERE sessionId = '".$sessionId."'");
        return false;
      }
    } else {
      $query = $mdb2->query("INSERT INTO clients_sessions (sessionId,time,ipAddress) VALUES('".$sessionId."','".time()."','".$_SERVER['REMOTE_ADDR']."')");
      return false;
    }
  }
  
  private function sessionId() {
    return $_REQUEST['PHPSESSID'];
  }
}

?>