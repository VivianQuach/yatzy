<?php
require_once('_config.php');
?>

<div id="output">--</div>
<button id="version">Version</button>
<button id="roll-die">Roll Die</button>

<script>
const output = document.getElementById("output");
const version = document.getElementById("version");
const rollDie = document.getElementById("roll-die");

version.onclick = function(e) {
  output.innerHTML = "Look up version clicked";
}

rollDie.onclick = function(e) {
  fetch('roll_die.php')
    .then(response => response.json())
    .then(data => {
      output.innerHTML = "Rolled: " + data.roll;
    })
    .catch(error => {
      console.error('Error:', error);
    });
}
</script>


