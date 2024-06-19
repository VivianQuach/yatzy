<?php 
namespace yatzy\app\models;

 class YatzyGame{
    private $dice;
    private $roll_num;
    private $rerolls;
    private $d;

    function __construct(){
        $this->dice = [];
        $this->roll_num = 0; 
        $this->rerolls = 0; 
        $this->d = new Dice(); 
    }
    function get_roll(){
        return  $this->roll_num; 
    }
    function get_reroll(){
        return  $this->rerolls; 
    }
    function get_dice(){
        return  $this->dice; 
    }
    function roll_dice(){
        $this->roll_num++; 
        $this->rerolls = 0; 
        $this->dice =  $this->d->multi_roll(5); 
    }
    function reroll_dice($position_rerolling){
        if( $this->rerolls >= 3){
            return; 
        }
        $count = 0; 
        for($x = 0; $x < 5; $x++){
            if($x == $position_rerolling[$count]){
                $this->dice[$x] =  $this->d->roll(); ;
            }
        }
        $this->rerolls++; 
    }
 }