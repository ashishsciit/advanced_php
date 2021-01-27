<?php
class Profile extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    public function player_image($id){
        return APPPATH."images/" .$id. ".png";
    }

    public function upload_image($image, $name){
        $image = $image;
        $name = APPPATH . 'images/'.$name;
        $realImage = base64_decode($image);
    
        if(!file_put_contents($name,$realImage)){
            return false;
        }
        return true;
    }
}