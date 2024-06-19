<?php 
namespace yatzy\app\models;

class Dice {
    function roll(){
        return rand(1,6); 
    }
    function multi_roll($num_roll){
        $roll_values = array(); 
        for($x = 0; $x < $num_roll; $x++){
            $roll_values[] = $this->roll();
        }
        return $roll_values; 
    }
}