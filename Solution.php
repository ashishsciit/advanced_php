<?php
class Solution {

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
    public function climbStairs($n) {
        return $this->fib($n+1);
    }
    public function fib($n) {
        $a = 0;
        $b = 1;
        $res = $b;
        for($i = 2; $i <= $n; $i++) {
            $res = $a + $b;
            $a = $b;
            $b = $res;
        }
        return $res;
    }

    // 50% probability of 0 and 1
    function rand50(){
        return rand() & 1;
    }
    // 75% probability of 1 and 25% probability of 0
    function rand75(){
        return $this->rand50() | $this->rand50();
    }
    // 75% probability of 0 and 25% probability of 1
    function rand25(){
        return $this->rand50() | $this->rand50();
    }
}

$solution = new Solution();
$h = 5;
$m = 30;
$n = 4;
echo "Angle of $h:$m is ". $solution->angleClock(5,30). " degree" . "<br/>";
echo "climibing $n stairs will have ". $solution->climbStairs($n) . " distinct ways <br/>"; 
echo $solution->rand50() . " <br/>";
echo $solution->rand75() . " <br/>";
echo $solution->rand25() . " <br/>";


echo "<br/><br/><br/><br/> Try to refresh the page to see changing results of 0 and 1 generation";