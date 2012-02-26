<?php
//DB Access Info
define('DB_READY',true);
require "calDB.php";

?><div id="content">
<?php
if (!empty($_REQUEST['username']) && !empty($_REQUEST['password'])){
  $user = mysql_fetch_assoc(mysql_query("SELECT user_id, user_password FROM phpbb_users WHERE CONVERT(username USING UTF8) = '".$_REQUEST['username']."'"));
  include "includes/PasswordHash.php";
  $t_hasher = new PasswordHash(8, TRUE);
  $hash = $user['user_password']; //from database
  $check = $t_hasher->CheckPassword($_REQUEST['password'], $hash);
  //$check will be true or false if the passwords match
  if ($check == true) {
    /* On default installs, this should be (group_id = 5 OR group_id = 4)
       On upgraded installs, this may be different, check in phpBB ACP to check.
       May add auto-check in a future version. */
    $rankCheck = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS count FROM phpbb_user_group WHERE user_id = ".$user['user_id']." AND (group_id = 970 OR group_id = 969)"));
    if ($rankCheck['count'] < 1 || $_REQUEST['ownLinks'] == "true") {
      $linkOp = 2;
    } elseif (($rankCheck['count'] == 1 || $rankCheck['count'] == 2) && $_REQUEST['ownLinks'] != "true") {
      $linkOp = 1;
    }
?>
<table class="tablebg" cellspacing="1" width="100%">

      <tr>

         <td class="cat"><h4>Event Administration</h4></td>

      </tr>
      <tr>

         <td class="row1">
           <form name="eventEdit" action="calEdit.php?mode=edit" method="post">
              <table class="tablebg" width="100%">
                <tr>
                  <td align="right" width="50%"><strong>Event to Edit: </strong></td>
                  <td><select name="event"><?php
                  if ($linkOp == 1) {
                     $eventSQL = mysql_query("SELECT event_id,event_desc,event_time FROM ".$config['db']['prefix']."calendar ORDER BY event_time ASC");
                   } elseif ($linkOp == 2) {
                     $eventSQL = mysql_query("SELECT event_id,event_desc,event_time FROM ".$config['db']['prefix']."calendar WHERE user_id = ".$user['user_id']." ORDER BY event_time ASC");
                   }
                   while ($event = mysql_fetch_assoc($eventSQL)) {
                     echo "<option name=\"link\" value=\"".$event['event_id']."\">".$event['event_name']." ".date("M d, Y @ H:i",$event['event_time'])."</option>";
                  }?></select></td>
               </tr>
               <tr>
                 <td colspan="2" align="center"><input type="submit" value="Edit" />
                 <input type="hidden" name="auth" value="true" /></td>
               </tr>
              </table>
           </form></td>
         </tr>
         <tr>
           <td class="row1">
             <form name="eventDelete" action="calEdit.php?mode=delete" method="post" onsubmit="confirmDelete(); return false">
               <table class="tablebg" width="100%">
                 <tr>
                   <td align="right" width="50%"><strong>Event(s) to Delete</strong></td>
                   <td><select name="event[]" size="6" multiple="multiple"><?php
                   if ($linkOp == 1) {
                     $eventSQL = mysql_query("SELECT event_id,event_desc,event_time FROM ".$config['db']['prefix']."calendar ORDER BY event_time ASC");
                   } elseif ($linkOp == 2) {
                     $eventSQL = mysql_query("SELECT event_id,event_desc,event_time FROM ".$config['db']['prefix']."calendar WHERE user_id = ".$user['user_id']." ORDER BY event_time ASC");
                   }
                   while ($event = mysql_fetch_assoc($eventSQL)) {
                   echo "<option name=\"link\" value=\"".$event['event_id']."\">".$event['event_name']." ".date("M d, Y @ H:i",$event['event_time'])."</option>";
                   }?></select></td>
                 </tr>
                 <tr>
                   <td colspan="2" align="center"><input type="submit" value="Submit" onclick="confirmDelete();return false" />
                   <input type="hidden" name="auth" value="true" /></td>
                 </tr>
               </table></td>
             </tr>
</table><?php } else { // Password check
  $message = "Username or password incorrect.";
  $color = "cc0000";
                 ?><table class="tablebg" cellspacing="1" width="100%">
      <tr>
         <td class="cat"><h4>Information</h4></td>
      </tr>
      <tr>
         <td class="row1" align="center" valign="middle"><p style="text-align:center;width:75%;background-color:#<?php echo $color; ?>;font-weight:bold;height:70px;vertical-align:middle"><br /><?php echo $message; ?></p>
         </td>
      </tr>
  </table><?php }
} else { 
  $message = "Username or password not supplied.";
  $color = "cc0000";
  ?><table class="tablebg" cellspacing="1" width="100%">
      <tr>
         <td class="cat"><h4>Information</h4></td>
      </tr>
      <tr>
         <td class="row1" align="center" valign="middle"><p style="text-align:center;width:75%;background-color:#<?php echo $color; ?>;font-weight:bold;height:70px;vertical-align:middle"><br /><?php echo $message; ?></p>
         </td>
      </tr>
  </table><?php
} ?>

<p style="text-align:center"><input type="button" value="&lt;&lt; Return to Calendar" onclick="window.location='./calendar.php'" /></p>
  
</div><!--content-->