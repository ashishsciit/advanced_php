<?php


$string = "PHP is a great web scripting languate and php is one of the greatest choice among the developrs.";
echo $string . '<br/>';
preg_match_all('/P|w|s/i',$string, $array);
print_r($array);

?>