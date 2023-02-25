<?php 

namespace Controllers;

use MVC\Router;

class GiftController{
    public static function index(Router $router){
        session_start();
        isAdmin();
        isLogin();
        $alerts = [];

        // Render a la vista 
        $router->render('admin/gifts/index', [
            'title' => 'Regalos',
            'alerts' => $alerts
        ]);
    }
}