<?php
// $handle = fopen("simple.txt","r");
// echo fgets($handle);
// while(!feof($handle)) { // feof returns true if handle reached end of the file else
//     $data = fgets($handle); // fgets returns one line of the given time
//     echo $data . "<br>";
// }
// while(!feof($handle)) { 
//     $char = fgetc($handle); // returns a character
//     if($char == "\n") {
//         $char = "<br \>";
//     }
//     echo $char;
// }
// fclose($handle);

// $data = file_get_contents("simple.txt"); // reads and returns full conetent of a file
// $data = str_replace("\n","<br />", $data, $i);
// echo $data;
// echo $i;

$file = "simple.txt";
// if(file_exists($file)){ // return true if file exists else false
// $data = file("simple.txt"); // stores the files content in to an array with each line in an index
// echo $data[0] . "<br>";
// echo $data[1] . "<br>";
// echo filesize($file); 
// }
// $file_handle = fopen($file, "a"); // a for append from eof and w for write from beginning
// $data = fread($file_handle, filesize($file)); // reads file handle upto the give length bytes size
// $data = str_replace("\n","<br/>",$data); 
// echo $data;
// fwrite($file_handle, " Appended text"); // writes to file

// fclose($file_handle);

file_put_contents($file, " Hello PHP", FILE_APPEND);
?>