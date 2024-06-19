<?php 
namespace yatzy\app\models;

 class YatzyGame{
    private $dice;
    private $roll_num;
    private $rerolls;
    private $d;
    private $scores = []; 
    private $score;
    private $bonus;

    function __construct(){
        $this->dice = [];
        $this->roll_num = 0; 
        $this->rerolls = 0; 
        $this->d = new Dice(); 
        $this->scores = ["ones"=> 0, "twos"=> 0, "threes"=> 0, "fours"=> 0, "fives"=> 0, "sixes"=> 0, "chance"=> 0, "three-of-a-kind"=> 0, "four-of-a-kind"=> 0, "yahtzee"=> 0, "sm-straight"=> 0, "lg-straight"=> 0, "full-house"=> 0];
        $this->score = 0;
        $this->bonus = 0;
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
    function get_scores() {
        return $this->scores;
    }

    function set_score($score) {
        $this->score = $score;
    }

    function get_score() {
        return $this->score;
    }

    function set_bonus($bonus) {
        $this->bonus = $bonus;
    }

    function get_bonus() {
        return $this->bonus;
    }
    function update_score($score_box) {
        $this->scores[$score_box] = YatzyEngine::score_turn($this, $score_box);
        YatzyEngine::update_overall_score($this);
    }
 }