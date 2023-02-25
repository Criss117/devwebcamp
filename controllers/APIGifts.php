<?php 

namespace Controllers;

use Models\Gift;
use Models\Register;

class APIGifts{
    public static function index(){
        session_start();
        isAdmin();
        isLogin();
        
        $gifts = Gift::all();
        
        foreach($gifts as $gift){
            $gift->total = Register::countArray(['giftId' => $gift->giftId, 'packageId' => "1"]);
        }

        echo json_encode($gifts);
        return;
    }
}