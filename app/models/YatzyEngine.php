<?php 
namespace yatzy\app\models;
class YatzyEngine{
    public static function score_turn(YatzyGame $game, $score_box){
        $dice =  $game->get_dice(); 
        $amount = [];
        for($x = 0; $x < 5; $x++){
            $amount[] = self::count_dice($dice, $x+1); 
        }
        switch ($score_box){
            case "ones":
                 return self::count_dice($dice, 1)*1;
            case "twos": 
                return self::count_dice($dice, 2)*2;
            case "threes": 
                return self::count_dice($dice, 3)*3;
            case "fours": 
                return self::count_dice($dice, 4)*4;
            case "fives": 
                return self::count_dice($dice, 5)* 5;
            case "sixes":
                return self::count_dice($dice, 6)*6;
            case "chance":
                return self::calculate_chance($dice);
            case "three-of-a-kind": 
                return self::calculate_3OfAKind($amount);
            case "four-of-a-kind":
                return self::calculate_4OfAKind($amount);
            case "yahtzee": 
                return self::calculate_yahtzee($amount);
            case "sm-straight": 
                return self::score_small_straight($dice);
            case "lg-straight": 
                return self::score_small_straight($dice);
            case "full-house": 
                return self::score_full_house($dice);
            default: 
                return 0;
        }  
    }
    public static function update_overall_score(YatzyGame $game){
        $scores = $game->get_scores();
        $total_score = array_sum($scores);
        $bonus = 0;

        // Assuming a bonus is given if the sum of the upper section (ones, twos, etc.) is >= 63
        $upper_section = ['ones', 'twos', 'threes', 'fours', 'fives', 'sixes'];
        $upper_score = array_sum(array_intersect_key($scores, array_flip($upper_section)));

        if ($upper_score >= 63) {
            $bonus = 50;
        }

        $lower_section = ["chance", "three-of-a-kind", "four-of-a-kind", "yahtzee", "sm-straight", "lg-straight", "full-house"];
        $lower_score =  array_sum(array_intersect_key($scores, array_flip($lower_section)));
        $game->set_bonus($bonus);
        $game->set_score($total_score + $bonus);
    }

    private static function count_dice($dice, $value){
        $num = 0; 
        for($x = 0; $x < 5; $x++){
            if($dice[$x] == $value){
                $num++; 
            }
        }
        return $num; 
    }
    private static function calculate_chance($dice){
        $chance = 0;  
        for($i = 0; $i < 5; $i++){
            $chance += $dice[$i];
        }
        return $chance; 
    }
    private static function calculate_3OfAKind($amount){
        $kind3 = 0; 
        for($i = 0; $i < sizeof($amount); $i++){
            if($amount[$i] >= 3){
                $kind3 = ($i + 1)*3;
            }
        }
        return $kind3;
    }
    private static function calculate_4OfAKind($amount){
        $kind4 = 0; 
        for($i = 0; $i < sizeof($amount); $i++){
            if($amount[$i] >= 4){
                $kind4 = ($i + 1)*4;
            }
        }
        return $kind4; 
    }
    private static function calculate_yahtzee($amount){
        $yahtzee = 0; 
        for($i = 0; $i < sizeof($amount); $i++){
            if($amount[$i] > 4){
                $yahtzee = ($i + 1)*4;
            }
        }
        return $yahtzee; 
    }
    private static function score_small_straight($dice) {
        sort($dice);
        $unique_dice = array_unique($dice);

        if (count($unique_dice) == 5 && (
            ($unique_dice == [1, 2, 3, 4]) || ($unique_dice == [ 2, 3, 4, 5]) ||
            ($unique_dice == [ 3, 4, 5, 6]) 
        )) {
            return 30; 
        }
        return 0;
    }

    private static function score_large_straight($dice) {
        sort($dice);
        $unique_dice = array_unique($dice);

        if (count($unique_dice) == 5 && (
            ($unique_dice == [1, 2, 3, 4, 5]) ||
            ($unique_dice == [2, 3, 4, 5, 6])
        )) {
            return 40;
        }
        return 0; 
    }

    private static function score_full_house($dice) {
        $counts = array_count_values($dice);
        arsort($counts);
        if (count($counts) == 2 && (current($counts) == 2 || current($counts) == 3)) {
            return 25; 
        }
        return 0; 
    }
}   