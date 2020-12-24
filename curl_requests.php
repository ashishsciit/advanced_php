<?php
// Simple Curl http request
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "https://www.google.com/search?q=apna+carpenters");
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $response = curl_exec($ch);
// curl_close($ch);
// echo $response;

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

// $ch = curl_init();

// $endpoint = "/api/users";
// $url = "https://reqres.in";

// $data_array = array(
//     "name" => "Ashish KS",
//     "job" => "Full Stack Developer",
// );

// $data = http_build_query($data_array);

// curl_setopt($ch, CURLOPT_URL, $url.$endpoint); // Request URL
// curl_setopt($ch, CURLOPT_POST, true); // POST Request
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // POST Data
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // GET Request

// $resp = curl_exec($ch);

// if($e = curl_error($ch)) {
//     echo $e;
// }
// else{
//     $decoded = json_decode($resp);
//     // print_r($decoded);
//     foreach($decoded as $key => $value) {
//         echo $key . ' : ' . $value . '<br/>' ; 
//     }
// }

// Scrap amazon images of keyword searches

// $ch = curl_init();
// $search_string = urlencode("movies 2020");
// $url = "https://www.amazon.in/s?k=$search_string";
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// // src="https://m.media-amazon.com/images/I/710weRkP-nL._AC_UY218_.jpg"

// $response = curl_exec($ch);
// preg_match_all("!https://m.media-amazon.com/images/I/[^\s]*?._AC_UY218_.jpg!", $response, $matches);

// $result = array_values(array_unique($matches[0]));
// // print_r($result);
// for($i = 0 ; $i < count($result) ; $i++) {
//     echo "<div style='float: left; margin: 10px 0 0 0; padding: 5px 10px;'>";
//     echo "<img src='$result[$i]'><br\>";
//     echo "</div>";
// }
// // curl_exec($ch);
// // echo $response;
// curl_close($ch);

class DownloadUrl {
    const URL_MAX_LENGTH = 2050;
    public function cleanUrl($url){
        if(isset($url) && !empty($url)) {
            $surl = filter_var($url, FILTER_SANITIZE_URL);
            if(strlen($surl) < self::URL_MAX_LENGTH) {
                return strip_tags($surl);
            }
        }
        return 0;
    }
    public function isUrl($url){
        $curl = $this->cleanUrl($url);
        if($curl){
            $vurl = filter_var($curl, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
            if($vurl != FALSE) {
                return $vurl;
            }
        }
        return 0;
    }

    public function extension($url) {
        $gurl = $url;
        $surl = $this->isUrl($gurl);
        if($surl) {
            $ext = preg_split("/[.]+/",$surl);
            $extension = end($ext);
            if(isset($extension)) {
                return $extension;
            }
        }
        return 0;
    }

    public function fileCreate($url){
        $extension = $this->extension($url);
        if($extension){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            // echo $response;
            $destination = "file.$extension";
            $file = fopen($destination, "w+");
            fputs($file, $response);
            if(fclose($file)){
                echo "File Downloaded";
            }else{
                echo "Failed File Download";    
            }
        }else{
            echo "Url invalid";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="curl_requests.php" method="post">
        <input type="text" name="search" id="search" value="<?= isset($_POST['search']) ? $_POST['search'] : '' ;?>">
        <input type="submit" value="Search">
    </form>
</body>
</html>

<?php

$download = new DownloadUrl();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["search"])){
    $download->fileCreate($_REQUEST["search"]);
    // echo $_REQUEST["search"];
}

?>