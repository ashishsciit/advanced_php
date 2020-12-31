<?php

function insertion_sort($elements){
    for($i=0 ; $i<count($elements) ; $i++) {
        $val = $elements[$i];
        $j=$i-1;
        while($j>=0 && $elements[$j] > $val){
            $elements[$j+1] = $elements[$j];
            $j--;
        }
        $elements[$j+1] = $val;
    }
    return $elements;
}

function selection_sort($elements){
    
    for($i = 0 ; $i < count($elements) ; $i++){
        $min = $i;
        for($j=$i+1 ; $j < count($elements) ; $j++) {
            if($elements[$j] < $elements[$min]){
                $min = $j;
            }
        }
        $elements = swap_position($elements, $i, $min);
        

    }
    return $elements;

}

function swap_position($elements, $left, $right){
    $temp = $elements[$right];
    $elements[$right] = $elements[$left];
    $elements[$left] = $temp;
    return $elements;
}

function simple_sort($elements) {
    $min = $elements[0];
    $sortedElements[0] = [$min];
    $count=0;
    for($i=1;$i<count($elements);$i++){
        if($elements[$i] < $min){
            
            $sortedElements[$count] = $elements[$i];
            $count++;
            $sortedElements[$count] = $min;
            $min = $elements[$i];
        }else{
            $sortedElements[$count+1] = $elements[$i];
        }
    }
    return $sortedElements;

}

function merge_sort($elements){
    if(count($elements) == 1) 
        return $elements;
    $mid = count($elements)/2;
    $left = array_slice($elements, 0, $mid);
    $right = array_slice($elements, $mid);
    $right = merge_sort($right);
    $left = merge_sort($left);
    $res = merge($left, $right);
    return $res;

}
function merge($left, $right) {
    $res = array();
    while(count($left) > 0 && count($right) > 0){
        if($left[0] > $right[0]){
            $res[] = $right[0];
            $right = array_slice($right, 1);
        }else{
            $res[] = $left[0];
            $left = array_slice($left, 1);
        }
    }
    
    while(count($left) > 0) {
        $res[] = $left[0];
        $left = array_slice($left, 1);
    }

    while(count($right) > 0){
        $res[] = $right[0];
        $right = array_slice($right, 1);
    }
    return $res;

}

function quick_sort($elements) {
    if(count($elements) < 2){
        return $elements;
    }
    $left = $right = array();
    $pivot_key = key($elements);
    $pivot  = array_shift($elements);
    foreach($elements as $element) {
        if($element <= $pivot){
            $left[] = $element;
        }else{
            $right[] = $element;
        }
    } 
    return array_merge(quick_sort($left), array($pivot_key=>$pivot), quick_sort($right));
}




$elements = [9,8,7,6,5,4,3];
print_r($elements);
echo "<br/>";
print_r(quick_sort($elements));


?>