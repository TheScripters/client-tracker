<?php
//DB Access Info
define('DB_READY',true);
require "calDB.php";

$monthName = (!isset($_GET['month'])) ? date("F") : date("F",mktime(0,0,0,$_GET['month'],1,2011));
$monthNum = (!isset($_GET['month'])) ? date("n") : $_GET['month'];
$year = (!isset($_GET['year'])) ? date("Y") : $_GET['year'];
$daysInMonth = cal_days_in_month(CAL_GREGORIAN,$monthNum,$year);
$firstOfMonth = mktime(0,0,0,$monthNum,1,$year);
$dayStart = date("w",$firstOfMonth);

$nextMonth = ($monthNum == 12) ? 1 : $monthNum + 1;
$nextYear = ($monthNum == 12) ? $year + 1 : $year;

$prevMonth = ($monthNum == 1) ? 12 : $monthNum - 1;
$prevYear = ($monthNum == 1) ? $year - 1 : $year;

?>

  <table width="100%">
    <tr>
      <td width="33%" style="text-align:left"><span style="font-size:11px;font-style:italic;font-variant:small-caps"><a href="" onclick="nextPrevMonth(<?php echo $prevMonth; ?>,<?php echo $prevYear; ?>); return false">&lt;&lt; Previous Month</a></span></td>
      <td width="33%" style="text-align:center"><span style="font-size:16px;font-weight:bold;font-style:italic"><?php echo $monthName." ".$year; ?></span></td>
      <td width="33%" style="text-align:right"><span style="font-size:11px;font-style:italic;font-variant:small-caps"><a href="" onclick="nextPrevMonth(<?php echo $nextMonth; ?>,<?php echo $nextYear; ?>); return false">Next Month &gt;&gt;</a></span></td>
    </tr>
  </table>
  <table width="100%">
    <tr>
      <th>Sun</th>
      <th>Mon</th>
      <th>Tue</th>
      <th>Wed</th>
      <th>Thu</th>
      <th>Fri</th>
      <th>Sat</th>
    </tr>
    <?php
      $time = $firstOfMonth;
      $newTime = mktime(0,0,0,$monthNum,$daysInMonth+1,date("Y"));
      $mEventsQuery = mysql_query("SELECT event_time FROM ".$config['db']['prefix']."calendar WHERE event_time > ".$time." AND event_time < ".$newTime);
      $mEventArray = array();
      for ($d=1;$d<=31;$d++) {
        $mEventArray[$d] = 0;
      }
      while ($mEvents = mysql_fetch_assoc($mEventsQuery)) {
        $mEventDate = date("j",$mEvents['event_time']);
        $mEventArray[$mEventDate]++;
      }
          for ($i=1;$i<=42;$i++) {
            if ($i % 7 == 1) echo "<tr>\n";
            echo "      <td style=\"text-align:center\">";
            if (($i - $dayStart >= 1) && ($i - $dayStart <=$daysInMonth)) {
              if (($i-$dayStart) == date("j") && $monthNum == date("n")) {
                print "<span style=\"color:#808a68;font-weight:bold\">";
                $today = 1;
              }
              if ($mEventArray[$i-$dayStart] >= 1 && $today != 1) {
                print "<span style=\"color:#cc6688;font-style:italic;font-weight:bold\" title=\"".$mEventArray[$i-$dayStart]." event(s) this day\">";
              }
              echo $i-$dayStart;
              if (($i-$dayStart) == date("j") || $mEventArray[$i-$dayStart] == 1) {
                print "</span>";
                if ($today == 1) { unset($today); }
              }
            }
            echo "</td>\n";
            if ($i%7 == 0) {
              if (($i - $dayStart) >= $daysInMonth) {
                echo "    </tr>\n";
              }
              elseif ((($i - $dayStart) < $daysInMonth)) echo "    </tr>\n";
            }
          }
              ?>
  </table><br />
  <?php
  if ($year != date("Y") || $monthNum != date("n")) {
    echo "<p style=\"text-align:right\"><a href=\"\" onclick=\"nextPrevMonth(".date("n").",".date("Y")."); return false\">Return to current month</a></p>";
  }
  ?>
  <p style="text-align:right">Jump to:&nbsp;
    <select id="month">
      <?php
      for($i=1;$i<=12;$i++) {
        $selected = ($i == $monthNum) ? " selected=\"selected\"" : "";
        echo "<option value=\"".date("n",mktime(0,0,0,$i,1,2011))."\"".$selected.">".date("F",mktime(0,0,0,$i,1,2011))."</option>";
      }
      ?>
    </select>&nbsp;&nbsp;
    <select id="year">
      <?php
      for($i=2038;$i>=1970;$i--) {
        $selected = ($i == $year) ? " selected=\"selected\"" : "";
        echo "<option value=\"".date("Y",mktime(0,0,0,1,1,$i))."\"".$selected.">".date("Y",mktime(0,0,0,1,1,$i))."</option>";
      }
      ?>
    </select>&nbsp;&nbsp;
    <input type="button" value="Go!" onclick="changeMonth()" />
  </p>
  <h4>Latest Events</h4>
  <?php
  $count = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS count FROM ".$config['db']['prefix']."calendar WHERE event_time > ".$time." AND event_time < ".$newTime));
  if ($count['count'] == 0) {
    echo "There are currently no events planned this month.<br /><br />";
  } else {
    echo "<ol style=\"margin-bottom:10px\">\n";
    $eventsSQL = mysql_query("SELECT event_time,event_desc,info_url,event_info FROM ".$config['db']['prefix']."calendar WHERE event_time > ".$time." AND event_time < ".$newTime." ORDER BY event_time ASC LIMIT 0,5");
    while ($events = mysql_fetch_assoc($eventsSQL)) {
      echo "    <li style=\"margin-left:10px;margin-bottom:5px\" title=\"".$events['event_info']."\">";
      echo $events['event_desc']." - ".date("M d, Y @ g:i A T",$events['event_time']);
      if (strlen($events['info_url']) > 0) {
        echo " <a href=\"".htmlspecialchars($events['info_url'],ENT_COMPAT,"UTF-8",false)."\" onclick=\"window.open('".htmlspecialchars($events['info_url'],ENT_COMPAT,"UTF-8",false)."'); return false\">More Info</a>";
      }
      echo "</li>\n";
    }
    echo "  </ol>";
  }
  ?>  <p style="text-align:center"><a href="calAddEvent.php">Add an event</a></p>
    <p style="text-align:center"><a href="calEditEvent.php">Edit/Delete an event</a></p>