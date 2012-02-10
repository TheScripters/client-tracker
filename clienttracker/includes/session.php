<?php
// session.php

class sessionHandler {
  private $phpSessionId;
  private $seassionId;
  private $logged_in;
  private $userId;
  private $sessionTimeout = 600;
  private $sessionLifespan = 3600;
  
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
  }
  
  private function compareIp($storedIp,$currIp = $_SERVER['REMOTE_ADDR']) {
    global $mdb2;
    
    $ipSensCfg = $mdb2->query("SELECT value FROM clients_config WHERE id = 'ip_sensitivity'");
    $ipSens = $ipSensCfg->fetchOne();
    
    $oldIp = explode(".",$storedIp);
    $newIp = explode(".",$currIp);
    
    $success = 0;
    $failed = 0;
    for ($i=0;$i==($ipSens-1);$i++) {
      if ($oldIp[$i] == $newIp[$i]) {
        $success++;
      } else {
        $failed++;
      }
      if ($failed >= 1) {
        return false;
      } else {
        return true;
      }
    }
  }
}

?>