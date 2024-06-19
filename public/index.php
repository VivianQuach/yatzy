<?php
require_once('_config.php');

use yatzy\app\models\Dice;
use yatzy\app\models\YatzyGame;

$d = new Dice();

for ($i=1; $i<=5; $i++) {
  echo "ROLL {$i}: {$d->roll()}<br>";
}
$y = new YatzyGame(); 
$y->roll_dice();
$dice = $y->get_dice();
echo "Hello <br>";
echo "Dice values: " . implode(", ", $dice) . "<br>";
echo "world <br>";
