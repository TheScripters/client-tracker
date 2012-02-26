<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Coronado Neighborhood Association</title>
<script type="text/javascript">AC_FL_RunContent = 0;</script>
<script src="js/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/mootoolsBackend.js"></script>
<script type="text/javascript" src="js/slimbox.js"></script>
<link rel="stylesheet" href="css/slimbox.css" type="text/css" media="screen" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script src="js/calendar.js" type="text/javascript"></script>
<script type="text/javascript" src="js/formfieldlimiter.js">

/***********************************************
* Form field Limiter v2.0- &#169; Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
</head>

<body>
<div id="bgWrapper">
<div id="wrapper">
<?php include "includes/header.php"; ?>
<?php include "includes/sidebar.php"; ?><!--columnLeft-->
  
<div id="content">
  <h1>Calendar Authentication</h1>
  
  <p>In order to add events to the calendar, you must be a registered member of the <a href="./forum/" onclick="window.open('http://www.gcna.info/forum');return false">forum</a>.</p>
  
  <form action="calAuth.php" method="post">
    <table>
      <tr>
        <th style="text-align:right;width:90px">Login ID:</th>
        <td><input type="text" maxlength="20" name="username" /></td>
      </tr>
      <tr>
        <th style="text-align:right;width:90px">Password:</th>
        <td><input type="password" maxlength="30" name="password" /></td>
      </tr>
      <tr>
        <td colspan="2"><hr /></td>
      </tr>
      <tr>
        <th style="text-align:right;width:90px">Event Name:</th>
        <td><input type="text" maxlength="50" name="event_desc" /> (50 characters max)</td>
      </tr>
      <tr>
        <th style="text-align:right;vertical-align:top;width:90px">Event date:</th>
        <td><select name="event_month"><?php for($i=1;$i<=12;$i++) {
        $selected = ($i == date("n")) ? " selected=\"selected\"" : "";
        echo "<option value=\"".date("n",mktime(0,0,0,$i,1,2011))."\"".$selected.">".date("F",mktime(0,0,0,$i,1,2011))."</option>"; } ?></select> <input type="text" name="event_day" size="2" maxlength="2" />, <input type="text" name="event_year" size="4" maxlength="4" />
        </td>
      </tr>
      <tr>
        <th style="text-align:right;vertical-align:top;width:90px">Event time:</th>
        <td><input type="text" name="event_time" size="5" maxlength="5" /><br />
            <span style="font-size:10px">Example: 22:30; 05:30</span>
        </td>
      </tr>
      <tr>
        <th style="text-align:right;width:90px;vertical-align:top">Brief Info:</th>
        <td><textarea style="font-family:Arial" id="event_info" name="event_info" rows="4" cols="30"></textarea><br />
          <span style="font-size:10px">Location, etc. (Optional)</span><br />
          <p style="margin-top: -4px" id="event-info"></p></td>
      </tr>
      <tr>
        <th style="text-align:right;width:90px">Info URL:</th>
        <td><input type="text" maxlength="255" name="info_url" /><br />
          <span style="font-size:10px">(Optional)</span></td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center"><input type="submit" value="Add to Calendar" /> <input type="reset" value="Reset Form" /></td>
      </tr>
      <tr>
        <td colspan="2"><hr /></td>
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
  
  <p>Note: Once you click "Add to Calendar" your username and password will be compared to the phpBB database and checked for a valid, active account. Guests are not allowed to post events to this calendar application.</p>
  
  <p style="text-align:center"><input type="button" value="&lt;&lt; Return to Calendar" onclick="window.location='./calendar.php'" /></p>
  
</div><!--content-->

<div id="full">
<div id="other"></div>
<div id="wideMiddle">
  <a target="_blank" href="http://www.fairviewplace.org/">Fairview Place</a>
  <a target="_blank" href="http://encantopalmcroft.org/">Encanto/Palmcroft</a>
  <a target="_blank" href="http://www.fqstory.org/">F.Q. Story</a>
  <a target="_blank" href="http://willohistoricdistrict.com/">Willo Historic District</a>
  <a target="_blank" href="http://windsorsquarephoenix.org/">Windsor Square</a>
  <a target="_blank" href="http://ccpark.org/">Country Club Park</a>
  <a target="_blank" href="http://www.garfieldorganization.com/">Garfield Organization</a>
  <a target="_blank" href="http://phoenix.gov/HISTORIC/residents.html#DIST">Other Historic Districts</a>
</div>
<div class="wideBottom"></div>
<div id="kids"></div>
<div id="wideMiddleKids">Hey kids! This site isn't just for Mom and Dad... there's a ton of cool stuff for you, too! Check out these links!<br />
  <a target="_blank" href="http://kids.nationalgeographic.com/">National Geographic</a>
  <a target="_blank" href="http://kids.discovery.com/">Discovery</a>
  <a target="_blank" href="http://www.nasa.gov/audience/forstudents/k-4/index.html">NASA-Kids</a>
  <a target="_blank" href="http://www.funology.com/">Funology</a>
  <a target="_blank" href="http://www.brainpop.com/">BrainPop</a>
  <a target="_blank" href="http://www.freerice.com/">FreeRice</a>
  <a target="_blank" href="http://www.spacestoplay.org">SpacestoPlay.org</a>
</div>
<div class="wideBottom"></div>
<?php include("includes/footer.php") ?>
</div><!--full-->
</div><!--wrapper-->
</div><!--bgWrapper-->
</body>
</html>