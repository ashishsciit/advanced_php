<?php
class Solution {
    function isPalindrome($x) {
        if($x < 0){
            return "false";
        }
        $rev = $this->reverse($x);
        // echo $rev;
        if($x == $rev) {
            // echo "what";
            return "true";
        }
        return "false";
            
    
        // return "false";
    }
    
    function reverse($x) {
        $rev = 0;
        while((int)$x != 0){
            $mod = $x % 10;
            $x /= 10;
            $rev = $rev * 10 + $mod;
        }
        if($x < -(2 ** 31) && $x > (2 ** 31)){
            return 0;
        }
        return $rev;  
    }
}

$solution = new Solution;
echo $solution->isPalindrome(-101);
?>  