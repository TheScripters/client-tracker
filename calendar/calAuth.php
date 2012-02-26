<?php
//DB Access Info
define('DB_READY',true);
require "calDB.php";

if (!empty($_REQUEST['username']) && !empty($_REQUEST['password'])){
  $user = mysql_fetch_assoc(mysql_query("SELECT user_id, user_password FROM phpbb_users WHERE CONVERT(username USING UTF8) = '".$_REQUEST['username']."'"));
  include "includes/PasswordHash.php";
  $t_hasher = new PasswordHash(8, TRUE);
  $hash = $user['user_password']; //from database
  $check = $t_hasher->CheckPassword($_REQUEST['password'], $hash);
  //$check will be true or false if the passwords match
  if ($check === true) {
    if (!empty($_REQUEST['event_desc']) && !empty($_REQUEST['event_day']) && !empty($_REQUEST['event_year']) && !empty($_REQUEST['event_time'])){
      $rTime = explode(":",$_REQUEST['event_time']);
      $time = mktime($rTime[0],$rTime[1],0,$_REQUEST['event_month'],$_REQUEST['event_day'],$_REQUEST['event_year']);
      if ($time === false) {
        $color = "cc0000";
        $message = "Invalid date format! You'll have to try again.";
      } else {
        $result = mysql_query("INSERT INTO ".$config['db']['prefix']."calendar VALUES(NULL,'".$time."','".$_REQUEST['event_desc']."','".$_REQUEST['info_url']."','".$_REQUEST['event_info']."','".$user['user_id']."')");
        if (!$result){
          $color = "cc0000";
          $message = "Fatal Error: ".mysql_error();
        } else {
          $color = "00cc00";
          $message = "Event added successfully!";
        }
      }
    } else {
      $color = "cc0000";
      $message = "Please fill in all fields!";
    }
  } elseif ($check !== true) {
    $color = "cc0000";
    $message = "Username or password was incorrect!";
  }
  unset($t_hasher); //cleanup
} else {
  $color = "cc0000";
  $message = "Username or password not supplied!";
}
?>  
<div id="content">
  <table class="tablebg" cellspacing="1" width="100%">
      <tr>
         <td class="cat"><h4>Information</h4></td>
      </tr>
      <tr>
         <td class="row1" align="center" valign="middle"><p style="text-align:center;width:75%;background-color:#<?php echo $color; ?>;font-weight:bold;height:70px;vertical-align:middle"><br /><?php echo $message; ?></p>
         </td>
      </tr>
  </table>
  
  <p style="text-align:center"><input type="button" value="&lt;&lt; Return to Calendar" onclick="window.location='./calendar.php'" /></p>
  
</div><!--content-->