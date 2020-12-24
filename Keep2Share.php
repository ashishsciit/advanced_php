<?php

class Keep2Share {
    public $ch;
    public $grant_id;
    public $client_secret;
    public $csrfToken;
    public $grant_type;
    public $username;
    public $password;
    public $loggedIn;
    
    public function __construct($username, $password){
        $this->ch = curl_init("https://api.k2s.cc/v1/auth/token");
        $this->grant_id = "k2s_web_app";
        $this->client_secret = "pjc8pyZv7vhscexepFNzmu4P";
        $this->csrfToken = "cc3ea09abb642";
        $this->grant_type = "password";
        $this->username = $username;
        $this->password = $password;
        $this->loggedIn = $this->loginToken();
    }
    // Check user login
    public function loginToken(){
        $data = array(
            "client_id" => $this->grant_id,
            "client_secret" => $this->client_secret,
            "csrfToken" => $this->csrfToken,
            "grant_type" => $this->grant_type,
            "password" => $this->password,
            "username" => $this->username
        );
        
        $data = http_build_query($data);
        
        curl_setopt($this->ch, CURLOPT_URL, "https://api.k2s.cc/v1/auth/token");
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookie.txt");
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        $tokenResponse = curl_exec($this->ch);
        if($tokenResponse){
            // $decodedLoginTokenResponse = json_decode($tokenResponse);
            // return $decodedLoginTokenResponse;
            return true;
        }
        return false;
    }
    // Get logged in user profile response
    public function loggedInUserResponse(){
        if($this->loggedIn) {

            curl_setopt($this->ch, CURLOPT_URL, "https://api.k2s.cc/v1/users/me");
            curl_setopt($this->ch, CURLOPT_POST, 0);

            curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookie.txt");
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
            $userResponse = curl_exec($this->ch);
            if($userResponse){
                $decodedUserResponse = json_decode($userResponse);
                return $decodedUserResponse;
            }   
        }
        return false;
    }

    // Get Logged in user profile traffic statistics
    public function statisticsResponse()
    {
        if($this->loggedIn){        
            curl_setopt($this->ch, CURLOPT_URL, "https://api.k2s.cc/v1/users/me/statistic");
            curl_setopt($this->ch, CURLOPT_POST, 0);
            curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookie.txt");
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
            $statisticsResponse = curl_exec($this->ch);
            if($statisticsResponse){
                $decodedStatisticsResponse = json_decode($statisticsResponse);
                return $decodedStatisticsResponse;
            }
        }
        return false;
    }
    
}

// Instance of object of Keep2Share class for user login and information
$k2s = new Keep2Share("dalrock123@yahoo.com","Houston3");
$userAccountType = $k2s->loggedInUserResponse()->accountType;
$userTotalAllocatedTraffic = $k2s->statisticsResponse()->dailyTraffic->total;
$userTotalUsedTraffic = $k2s->statisticsResponse()->dailyTraffic->used;
$userTrafficLeftToday = $userTotalAllocatedTraffic - $userTotalUsedTraffic;
echo "<h2>Acoount Type: <h2><h4>" . $userAccountType . "</h4><br/>";
echo "<h2> Traffic left today for viewing/downloading: <h2><h4>" . $userTrafficLeftToday . " Bytes</h4></br/>";
echo "<h2>Used traffic today: <h2><h4>" . $userTotalUsedTraffic . " Bytes</h4><br/> ";
