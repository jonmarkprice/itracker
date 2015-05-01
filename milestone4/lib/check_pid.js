/* Cindy La & Jonathan Price */
"use strict";

window.onload = function()
{
  document.getElementById("pid").onkeyup = check_pid;
}

function check_pid()
{ 
  var pid = document.getElementById("pid").value;
  var request = new XMLHttpRequest();

  request.open("GET","lib/check_pid.php?pid="+pid, true);
  request.onload = function()
  {
    document.getElementById("pid_error").innerHTML = request.responseText;
  }
  request.send(null);
}

