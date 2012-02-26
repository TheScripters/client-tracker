<?php
//DB Access Info
define('DB_READY',true);
require "calDB.php";

?>
<div id="content">
<?php
if ($_GET['mode'] == "edit") { 
  $event = mysql_fetch_assoc(mysql_query("SELECT event_desc,event_time,info_url,event_info FROM ".$config['db']['prefix']."calendar WHERE event_id = ".$_REQUEST['event'])); ?>
  <h1 style="text-align:center">Editing Event</h1>
  <form action="calEdit.php?mode=editsub&amp;item=event" method="post">
              <table width="100%">
                <tr>
                  <td align="right" width="50%"><strong>Event Name:</strong></td>
                  <td><input type="text" name="event_desc" value="<?php echo $event['event_desc']; ?>" maxlength="50" /></td>
                </tr>
                <tr>
                  <td align="right"><strong>Event Time:</strong></td>
                  <td><input type="text" name="event_time" value="<?php echo date("M d, Y g:i A",$event['event_time']); ?>" /></td>
                </tr>
                <tr>
                  <th style="text-align:right;width:90px;vertical-align:top">Brief Info:</th>
                  <td><textarea style="font-family:Arial" id="event_info" name="event_info" rows="4" cols="30"><?php echo $event['event_info']; ?></textarea><br />
                    <span style="font-size:10px">Location, etc. (Optional)</span><br />
                    <p style="margin-top: -4px" id="event-info"></p></td>
                </tr>
                <tr>
                  <td align="right" width="50%"><strong>Info URL:</strong></td>
                  <td><input type="text" name="info_url" value="<?php echo $event['info_url']; ?>" maxlength="255" /></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><input type="submit" value="Edit" />
                  <input type="hidden" name="event_id" value="<?php echo $_REQUEST['event']; ?>" />
                  <input type="hidden" name="auth" value="true" /></td>
                </tr>
              </table>
           </form>
           
  <script type="text/javascript">
  fieldlimiter.setup({
	thefield: document.getElementById("event_info"), //reference to form field
	maxlength: 250,
	statusids: ["event-info"], //id(s) of divs to output characters limit. If non, set to empty array [].
	onkeypress:function(maxlength, curlength){ //onkeypress event handler
		//define custom event actions here if desired
	}
  })

  </script>
<?php } elseif ($_GET['mode'] == "delete" && $_REQUEST['auth'] == "true") { // Delete functions
  foreach ($_REQUEST['event'] as $event){
    $result = mysql_query("DELETE FROM ".$config['db']['prefix']."calendar WHERE event_id = ".$event." LIMIT 1");
    if (!$result){
      $color = "cc0000";
      $message = "Database update failed: ".mysql_error();
      $error = 1;
      break 1;
    }
  }
  if (!isset($error)) {
    $color = "00cc00";
    $message = "Event(s) successfully deleted!";
  }
?>
<table class="tablebg" cellspacing="1" width="100%">
      <tr>
         <td class="cat"><h4>Information</h4></td>
      </tr>
      <tr>
         <td class="row1" align="center" valign="middle"><p style="text-align:center;width:75%;background-color:#<?php echo $color; ?>;font-weight:bold;height:90px;vertical-align:middle"><br /><?php echo $message; ?></p>
         </td>
      </tr>
  </table><?php
} elseif ($_GET['mode'] == "editsub" && $_REQUEST['auth'] == "true") { // Update after editing
    $eventTime = strtotime($_REQUEST['event_time']);
    if ($eventTime < time()) {
        $color = "cc0000";
        $message = "Invalid date format. You'll have to try again.";
      } else {
    $result = mysql_query("UPDATE ".$config['db']['prefix']."calendar SET event_time = '".$eventTime."', event_desc = '".$_REQUEST['event_desc']."', info_url = '".$_REQUEST['info_url']."', event_info = '".$_REQUEST['event_info']."' WHERE event_id = ".$_REQUEST['event_id']." LIMIT 1");
    if (!$result){
          $color = "cc0000";
          $message = "Database update failed: ".mysql_error();
        } else {
          $color = "00cc00";
          $message = "Event successfully updated!";
        }
     }
?>
<table class="tablebg" cellspacing="1" width="100%">
      <tr>
         <td class="cat"><h4>Information</h4></td>
      </tr>
      <tr>
         <td class="row1" align="center" valign="middle"><p style="text-align:center;width:75%;background-color:#<?php echo $color; ?>;font-weight:bold;height:90px;vertical-align:middle"><br /><?php echo $message; ?></p>
         </td>
      </tr>
  </table><?php
} elseif ($_REQUEST['auth'] != "true" || !isset($_REQUEST['auth'])) {
   $color = "cc0000";
   $message = "Unauthorized changes detected."; ?>
<table class="tablebg" cellspacing="1" width="100%">
      <tr>
         <td class="cat"><h4>Information</h4></td>
      </tr>
      <tr>
         <td class="row1" align="center" valign="middle"><p style="text-align:center;width:75%;background-color:#<?php echo $color; ?>;font-weight:bold;height:90px;vertical-align:middle"><br /><?php echo $message; ?></p>
         </td>
      </tr>
  </table><?php
} ?>

  <p style="text-align:center"><input type="button" value="&lt;&lt; Return to Calendar" onclick="window.location='./calendar.php'" /></p>
  
</div><!--content-->