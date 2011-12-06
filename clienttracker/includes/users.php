<?php
// users.php

/*********************************
** Users Class for user/session **
** management.                  **
**                              **
** Functions include:           **
** logged_in,log_in,user_name,  **
** sessionId, logout            **
**********************************/

/* Note: This session management class
** does not keep track of users using
** the sessions. Only which sessions
** are active.
**
** Still to be added: Garbage cleaner
** for all old sessions.
*/

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
      if (($now-$sessTime['time']) <= 1800 && $sessTime['ipaddress'] == $_SERVER['REMOTE_ADDR']) {
        $update = $mdb2->query("UPDATE clients_sessions SET time = '".$now."' WHERE sessionId = '".$sessionId."'");
        if ($sessTime['data'] = "logged_in") {
          return true;
        } else {
          // This line really shouldn't be here... Just left for reference...
          //$query = $mdb2->query("DELETE FROM clients_sessions WHERE sessionId = '".$sessionId."'");
          return false;
        }
      } else {
        $_SESSION['message'] = "Something must have screwed up with comparing the IP Address..";
        // Remove active session from database, and create a new session.
        $query = $mdb2->query("DELETE FROM clients_sessions WHERE sessionId = '".$sessionId."'");
        if (PEAR::isError($mdb2)) {
          die($mdb2->getMessage());
        }
        session_regenerate_id();
        session_destroy();
        unset($_SESSION);
        session_id($sessionId);
        session_start();
        return false;
      }
    } else {
      $query = $mdb2->query("INSERT INTO clients_sessions (sessionId,time,ipAddress) VALUES('".$sessionId."','".time()."','".$_SERVER['REMOTE_ADDR']."')");
      return false;
    }
  }
  
  public function log_in() {
    global $mdb2;
    
    $sessionId = $this->sessionId();
    $query = $mdb2->query("UPDATE clients_sessions SET data = 'logged_in' WHERE sessionId = '".$sessionId."'");
    if (PEAR::isError($mdb2)) {
      die($mdb2->getMessage());
    }
  }
  
  private function sessionId() {
    return $_REQUEST['PHPSESSID'];
  }
  
  public function user_name($id) {
    global $mdb2;
    
    $query = $mdb2->query("SELECT clientName FROM clients_info WHERE clientId = '".$id."'");
    $userId = $query->fetchOne();
    return $userId;
  }
  
  public function logout() {
    global $mdb2;
    
    $sessionId = $this->sessionId();
    // Remove active session and create a new session.
    $query = $mdb2->query("DELETE FROM clients_sessions WHERE sessionId = '".$sessionId."'");
    session_regenerate_id();
    session_destroy();
    unset($_SESSION);
    session_id($sessionId);
    session_start();
  }
}

?>