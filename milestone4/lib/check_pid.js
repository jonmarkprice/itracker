/* Cindy La & Jonathan Price */
"use strict";

window.onload = function()
{
  document.getElementById("pid").onkeyup = check_pid;
}

function check_pid()
{
  var request = new XMLHttpRequest();

  request.open("GET","check_pid.php", true);
  request.onload = function()
  {
    document.getElementById("piderror").innerHTML = request.responseText;
  }
  request.send(null);
}

