function changeMonth() {
  if (window.XMLHttpRequest){
    var request = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    var request = new ActiveXObject("Microsoft.XMLHTTP");
  }
  var month = document.getElementById('month');
  var monthIndex = month.selectedIndex;
  var year = document.getElementById('year');
  var yearIndex = year.selectedIndex;
  var page = "calUpdate.php?month="+month[monthIndex].value+"&year="+year[yearIndex].value;
  request.open("GET",page,true);
  request.send(null);
  request.onreadystatechange = function() {
    var calendar = request.responseText;
    document.getElementById('calendar').innerHTML = calendar;
  }
}

function nextPrevMonth(month,year) {
  if (window.XMLHttpRequest){
    var request = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    var request = new ActiveXObject("Microsoft.XMLHTTP");
  }
  var page = "calUpdate.php?month="+month+"&year="+year;
  request.open("GET",page,true);
  request.send(null);
  request.onreadystatechange = function() {
    var calendar = request.responseText;
    document.getElementById('calendar').innerHTML = calendar;
  }
}

function confirmDelete() {
  var r=confirm("Are you sure you want to delete the selected item(s)?");
    if (r==true) {
      document.eventDelete.submit();
    } else {
      return false;
    }
}