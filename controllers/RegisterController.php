<?php 

namespace Controllers;

use MVC\Router;
use Models\Register;
use Classes\Pagination;
use Models\Package;
use Models\User;

class RegisterController{
    public static function index(Router $router){
        session_start();
        isAdmin();
        isLogin();
        
        $current_page = $_GET['page'];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);

        if(!$current_page || $current_page < 1){header('Location: /admin/register?page=1');}

        $records_per_page = 10;
        $total_records = Register::count();          

        $pagination = new Pagination($current_page,$records_per_page,$total_records);

        if($pagination->total_page() < $current_page){header('Location: /admin/register?page=1');}

        $register = Register::page($records_per_page, $pagination->offset());
        foreach($register as $reg){
            $reg->user = User::find($reg->userId);
            $reg->package = Package::find($reg->packageId);
        }
        //debuguear($register);

        // Render a la vista 
        $router->render('admin/register/index', [
            'title' => 'Usuarios Registrados',
            'register' => $register,
            'pagination' => $pagination->pagination()
        ]);
    }
}