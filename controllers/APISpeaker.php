<?php 

namespace Controllers;

use Models\Speaker;

class APISpeaker{
    public static function index(){
        session_start();
        isAdmin();
        isLogin();
        
        $speaker = Speaker::all();
        echo json_encode($speaker);
    }

    public static function speaker(){
        $speakerId = $_GET['id'];
        $speakerId = filter_var($speakerId, FILTER_VALIDATE_INT);
        
        if(!$speakerId || $speakerId < 1){
            echo json_encode([]);
            return;    
        }

        $speaker = Speaker::find($speakerId);
        echo json_encode($speaker, JSON_UNESCAPED_SLASHES);
    }
}