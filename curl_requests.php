<?php

// GET
// $ch = curl_init();
// $url = "https://reqres.in/api/users?page=2";

// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // GET Request

// $resp = curl_exec($ch);

// if($e = curl_error($ch)) {
//     echo $e;
// }else{
//     $decoded = json_decode($resp, true);
//     print_r($decoded['data'][0]['email']);
// }

// curl_close($ch);

// POST

$ch = curl_init();

$endpoint = "/api/users";
$url = "https://reqres.in";

$data_array = array(
    "name" => "Ashish KS",
    "job" => "Full Stack Developer",
);

$data = http_build_query($data_array);

curl_setopt($ch, CURLOPT_URL, $url.$endpoint);
curl_setopt($ch, CURLOPT_POST, true); // POST Request
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

if($e = curl_error($ch)) {
    echo $e;
}
else{
    $decoded = json_decode($resp);
    // print_r($decoded);
    foreach($decoded as $key => $value) {
        echo $key . ' : ' . $value . '<br/>' ; 
    }
}


?>