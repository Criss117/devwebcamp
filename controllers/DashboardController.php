<?php 

namespace Controllers;

use Models\Event;
use Models\Register;
use Models\User;
use MVC\Router;

class DashboardController{
    public static function index(Router $router){
        session_start();
        isAdmin();
        isLogin();

        //obtener ultimos registros
        $register = Register::get(5);
        foreach($register as $reg){
            $reg->user = User::find($reg->userId);
        }
        
        //calcular los ingresos
        $virtual = Register::count('packageId','2');
        $facetoface = Register::count('packageId','1');

        $income = ($virtual * 46.05) + ($facetoface * 233.19);

        //obtener eventos con mas y menos lugares disponibles
        $less_available = Event::orderbylimit('available','ASC','5');
        $more_available = Event::orderbylimit('available','DESC','5');
        
        // Render a la vista 
        $router->render('admin/dashboard/index', [
            'title' => 'Panel de administracion',
            'register' => $register,
            'income'=> $income,
            'less_available' => $less_available,
            'more_available' => $more_available
        ]);
    }
}