<?php
require_once('_config.php');

use yatzy\app\models\Dice;
use yatzy\app\models\YatzyGame;
use yatzy\app\models\YatzyEngine;

$d = new Dice();

for ($i=1; $i<=5; $i++) {
  echo "ROLL {$i}: {$d->roll()}<br>";
}

$game = new YatzyGame();
$game->roll_dice();
echo "Initial Dice Roll: " . implode(", ", $game->get_dice()) . "<br>";

$score_box = 'ones'; 
$game->update_score($score_box);

echo "Score for '$score_box': " . $game->get_scores()[$score_box] . "<br>";
echo "Overall Score: " . $game->get_score() . "<br>";
echo "Bonus: " . $game->get_bonus() . "<br>";
