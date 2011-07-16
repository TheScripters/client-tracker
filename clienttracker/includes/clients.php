<?php
// (c) 2010 TheScripters.com

class client {
  public function newClient($name,$email,$phones,$address) {
    global $mdb2;
    
    // Still deciding best method for creating the hash
    $hash = md5(sha(base64_encode($name)));
    
    $address = explode(" ",str_replace(",",$address));
    
    $query = $mdb2->exec("INSERT INTO clients_info VALUES (Null,'".$name."','".$email."','".$address[0]."','".$address[1]."','".$address[2]."','".$address[3]."','".$phone."','".$hash."')");
    if (PEAR::isError($query)) {
      die($mdb2->getMessage());
    }
    
    if ($query == 1) {
      $message =  $query." client added successfully!";
    } else {
      $message = "An error occurred, client was not added!";
    }
    
    return $message;
  }
  
  public function viewClientByName($name) {
    global $mdb2;
    
    $query = $mdb2->query("SELECT * FROM clients_info WHERE ClientName = '".$name."'");
    if (PEAR::isError($query)) {
      die($mdb2->getMessage());
    }    
    $result = $query->fetchRow();
    
    $query->free();
    
    return $result;
  }
  
  public function allClients() {
    global $mdb2;
    
    $query = $mdb2->query("SELECT * FROM clients_info");
    $i = 1;
    $clientsArray[0] = 0;
    while ($result = $query->fetchRow()) {
      foreach ($result as $key => $value) {
        $clientsArray[$i][$key] = $value;
      }
      ++$i;
    }
    $clientsArray[0] = $i - 1;
    return $clientsArray;
  }
  
  public function editClient($id,$data) {
    global $mdb2;
    
    if ($id == $data['id']) {
      $queryData = "UPDATE clients_info SET ";
      $queryData .= "ClientName = '".$data['name']."', ClientEmail = '".$data['email']."', ";
      $queryData .= "ClientAddress = '".$data['address']."', ClientCity = '".$data['city']."', ";
      $queryData .= "ClientState = '".$data['state']."', ClientZip = '".$data['zip']."', ";
      $queryData .= "ClientPhone = '".$data['phone']."' WHERE clientId = '".$id."'";
      $query = $mdb2->query($queryData);
    } else {
      $message = "Client ID mismatch!";
    }
    return $message;
  }
  
  // Used when a client wants to retrieve information
  // like a product key or default password.
  // It minimizes the use of passwords and the like.
  public function viewByHash($hash,$request) {
    global $mdb2;
    
    if ($request == "password") {
      $query = $mdb2->query("SELECT clientId FROM clients_info WHERE clientHash = '".$hash."'");
      if (PEAR::isError($query)) {
        die($mdb2->getMessage());
      }
      $pass = $mdb2->query("SELECT clientUserName,clientDefaultPass,clientDomain FROM accounts_info WHERE clientId = '".$query->fetchone()."'");
      while ($result = $pass->fetchRow()) {
        foreach ($result as $key => $value) {
          $clientInfo[$key] = $value;
        }
      }
      return $clientInfo;
    }
  }
  
  public function gatherData($id,$name,$email,$address,$city,$state,$zip,$phone) {
    $arr['id'] = $id;
    $arr['name'] = $name;
    $arr['email'] = $email;
    $arr['address'] = $address;
    $arr['city'] = $city;
    $arr['state'] = $state;
    $arr['zip'] = $zip;
    $arr['phone'] = $phone;
    
    return $arr;
  }
  
  private function randomkeys($length) {
    $key = null;
    $pattern = "0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
    for($i=0;$i<$length;$i++)
      {
        $key .= $pattern{rand(0,35)};
      }
    return $key;
  }
}

?>