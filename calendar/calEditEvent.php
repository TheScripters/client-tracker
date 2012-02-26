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
</head>

<body>
<div id="bgWrapper">
<div id="wrapper">
<?php include "includes/header.php"; ?>
<?php include "includes/sidebar.php"; ?><!--columnLeft-->
  
<div id="content">
  <h1>Calendar Authentication</h1>
  
  <form action="calAuthEdit.php" method="post">
    <table>
      <tr>
        <th style="text-align:right;width:155px">Login ID:</th>
        <td><input type="text" name="username" size="20" /></td>
      </tr>
      <tr>
        <th style="text-align:right;width:155px">Password:</th>
        <td><input type="password" name="password" size="20" /></td>
      </tr>
      <tr>
        <th style="text-align:right;width:155px;vertical-align:top">Own Submissions Only?</th>
        <td><input type="checkbox" name="ownLinks" value="true" /> <span style="font-size:10px">(Check to edit in user mode instead of admin mode -- "Admin" mode will allow edit/deletion of all items in the database)<br /><br />
          Note: This item will be ignored if you do not have admin/moderator priviledges.</span></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" value="Submit" /></td>
      </tr>
    </table>
  </form>
  
  <p>After you hit "Submit", your username and password will be checked against the phpBB database for a valid account. And events or links you've added will be available for edit or deletion.</p>
  
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