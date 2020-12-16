<?php
$name = array(1 => "Ashish", 4 => "Satish", 8 => "Sumanta", 3 => "Sonu");
unset($name[8]); // deletes the element of the array
print_r($name);
print_r(array_keys($name, "Ashish", false)); // returns array keys
?>  