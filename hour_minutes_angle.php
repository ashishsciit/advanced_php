<?php
class Solution {

    /**
     * @param Integer $hour
     * @param Integer $minutes
     * @return Float
     */
    function angleClock($hours, $minutes) {
        if($hours < 0 || $minutes < 0 || $hours > 12 || $minutes > 60){
            return "Wrong Input!";
        }else{
        
            if($hours == 12) $hours = 0;
            if($minutes == 60){
                $minutes = 0;
                $hours += 1;
            }
            if($hours > 12) $hours = $hours - 12;

            $hours_angle = 0.5 * ($hours * 60 + $minutes);
            $minutes_angle = 6*$minutes;
            $angle = abs($hours_angle - $minutes_angle);
            $angle = min(360-$angle, $angle);
            return $angle;
        }
    }
}