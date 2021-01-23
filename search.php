<?php

function linear_search($arr, $x){
    for($i = 0 ; $i < count($arr) ; $i++){
        if($arr[$i] == $x){
            return $i;
        }
    }
    return -1;
}

function binary_search($arr, $l, $r, $x){
    if($r >= $l){
            $mid = ceil($l + ($r - $l)/2);
            if($x == $arr[$mid]){
                return $mid;
            }
            if($x < $arr[$mid]){
                // left side
                return binary_search($arr, $l, $mid-1, $x);
            }
            // right side
            return binary_search($arr, $mid+1, $r, $x);

        }
    
    return -1;
}

$arr = [5,9,2,10,16,83,4];
$x = 83;
$n = count($arr);
$l = 0;
$r = $n-1;
// $res = linear_search($arr, $x);
$res = binary_search($arr, $l, $r, $x);
if($res != -1){
    echo "Element $x is present at position $res";
}else{
    echo "Element is not present in the array";
}