<?php
require_once('_config.php');

use Yatzy\Dice;

switch ($_GET["action"] ?? "version") {
case "roll":
    $d = new Dice();
    $data = ["value" => $d->roll()];
    break;
case "version":
default:
    $data = ["version" => "1.0"];
}

header("Content-Type: application/json");
echo json_encode($data);
?>

<div id="output">--</div>
<button id="version">Version</button>

<script>
const output = document.getElementById("output");
const version = document.getElementById("version");

version.onclick = function(e) {

const xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState == XMLHttpRequest.DONE) {
    if (xmlhttp.status == 200) {
      output.innerHTML = xmlhttp.responseText;
    }
  }
};

xmlhttp.open("GET", "/api.php", true);
xmlhttp.send();
}
</script>



