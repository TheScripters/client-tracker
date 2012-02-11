<?php
// session.php

class sessionHandler {
  private $phpSessionId;
  private $sessionId;
  private $logged_in;
  private $userId;
  private $sessionTimeout = 600;
  private $sessionLifespan = 3600;
  private $ipValid;
  
  public function __construct() {
    // Database Connection
    global $mdb2;
    
    session_set_save_handler(
      array(&$this, '_session_open_method'),
      array(&$this, '_session_close_method'),
      array(&$this, '_session_read_method'),
      array(&$this, '_session_write_method'),
      array(&$this, '_session_destroy_method'),
      array(&$this, '_session_gc_method')
    );
    
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $userIpAddress = $_SERVER['REMOTE_ADDR'];
    if ($_COOKIE['PHPSESSID']) {
      $this->phpSessionId = $_COOKIE['PHPSESSID'];
      $now = time();
      $timeout = $now-$this->sessionTimeout;
      $lifespan = $now-$this->sessionLifespan;
      
      $session = $mdb2->query("SELECT sessionId FROM clients_sessions WHERE phpSessionId = '".$this->phpSessionId."'
        AND userAgent = '".$userAgent."' AND created < '".$lifespan."' AND updated < '".$timeout."'");
      $sessId = $session->fetchOne();
      if ($sessId < 1 || PEAR::iserror($result)) {
        $result = $mdb2->exec("DELETE FROM clients_sessions WHERE phpSessionId = '".$this->phpSessionId."' OR created > '".$lifespan."'");
        unset($_COOKIE['PHPSESSID']);
      } else {
        $sessInfo = $mdb2->query("SELECT ipAddress FROM clients_sessions WHERE sessionId = '".$sessId."'");
        $ipAddress = $sessInfo->fetchOne();
        if ($this->compareIp($ipAddress,$userIpAddress) === false) {
          $this->ipValid = false;
        } else {
          $this->ipValid = true;
        }
      }
    }
    session_set_cookie_params($this->sessionLifespan);
    session_start();
  }
  
  public function isLoggedIn() {    
    return $this->logged_in;
  }
  
  private function compareIp($storedIp,$currIp) {
    global $mdb2;
    
    $ipSensCfg = $mdb2->query("SELECT value FROM clients_config WHERE id = 'ip_sensitivity'");
    $ipSens = $ipSensCfg->fetchOne();
    
    if ($ipSens != 0) {
      $oldIp = explode(".",$storedIp);
      $newIp = explode(".",$currIp);
    
      $success = 0;
      $failed = 0;
      for ($i=0;$i<=($ipSens-1);$i++) {
        if ($oldIp[$i] == $newIp[$i]) {
          $success++;
        } else {
          $failed++;
        }
      }
      if ($failed >= 1) {
        return false;
      } else {
        return true;
      }
    } else {
      return true;
    }
  }
  
  private function _session_read_method($id) {
    global $mdb2;
    
    $userAgent = $_SERVER['HTTP_USERG_AGENT'];
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $this->phpSessionId = $id;
    $failed = 1;
    $result = $mdb2->query("SELECT sessionId,loggedIn,userId FROM clients_sessions WHERE phpSessionId = '".$id."'");
    if ($result->numRows() > 0) {
      $info = $result->fetchRow();
      $this->sessionId = $info['sessionId'];
      if ($info['loggedIn'] == 1) {
        $this->logged_in = true;
        $this->userId = $info['userId'];
      } else {
        $this->logged_in = false;
      }
    } else {
      $this->logged_in = false;
      $types = array('integer','text','text','integer','integer','integer','integer','text','text');
      $result = $mdb2->prepare('INSERT INTO clients_sessions VALUES (?,?,?,?,?,?,?,?)',$types,MDB2_PREPARE_MANIP);
      $data = array('',$id,'','',time(),time(),0,0,$userAgent,$ipAddress);
      $affected = $result->execute($data);
      $insertedSQL = $mdb2->query("SELECT id FROM clients_sessions WHERE phpSessionId = '".$id."'");
      $insertedId = $insertedSQL->fetchOne();
      $this->sessionId = $insertedId;
    }
    return "";
  }
  
  
}

?>