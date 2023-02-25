<?php 

namespace Controllers;

use Classes\Email;
use Models\User;
use MVC\Router;

class AuthController{
    public static function login(Router $router){
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $user = new User($_POST);

            $alerts = $user->validateLogin();
            
            if(empty($alerts)) {
                // Verificar quel el usuario exista
                $user = User::where('email', $user->email);
                if(!$user || !$user->confirm ) {
                    User::setAlert('error', 'El Usuario No Existe o no esta confirmado');
                } else {
                    // El Usuario existe
                    if( password_verify($_POST['password'], $user->password) ) {  
                        // Iniciar la sesión 
                        $_SESSION['userId'] = $user->userId;
                        $_SESSION['name'] = $user->name;
                        $_SESSION['surname'] = $user->surname;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['admin'] = $user->admin ?? null;
                        
                        if($user->admin){
                            header('Location: '.$_ENV['HOST'].'admin/dashboard');
                        }else{
                            header('Location: '.$_ENV['HOST'].'finish-registration');
                        }

                    } else {
                        User::setAlert('error', 'Password Incorrecto');
                    }
                }
            }
        }

        $alerts = User::getAlerts();
        
        // Render a la vista 
        $router->render('auth/login', [
            'title' => 'Iniciar Sesión',
            'alerts' => $alerts
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        isLogin();
    }

    public static function create(Router $router){
        session_start();
        isLogin();
        $user = new User;
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            isAdmin();
            isLogin();
            $user->synchronize($_POST);
            $alerts = $user->validateNewAccount();

            if(empty($alerts)){
                $userExist = User::where('email',$user->email);
                if($userExist){
                    User::setAlert('error','El usuario ya esta registrado');
                    $alerts = User::getAlerts();
                }else{
                    //hashear el password
                    $user->hashPassword();
                    //eliminar password2
                    unset($user->password2);
                    //generar token
                    $user->createToken();                 
                    //crear usuario
                    $result = $user->save($user->userId);
                    //enviar email
                    $email = new Email($user->email,$user->name,$user->token);
                    $email->sendEmail(1);

                    if($result){
                        header('Location: '.$_ENV['HOST'].'message');
                    }
                }
            }
        }

        $router->render('auth/create',[
            'title' => 'Registrate en UpTask',
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function identify(Router $router){       
        session_start();
        isLogin();
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            isAdmin();
            isLogin();
            $user = new User($_POST);
            $alerts = $user->validateEmail();

            if(empty($alerts)){
                //buscar usuario
                $user = User::where('email',$user->email);
                if($user && $user->confirm === '1'){
                    //generar token
                    $user->createToken();
                    unset($user->password2);
                    //actualizar ususario
                    $user->save($user->userId);
                    //enviar email
                    $email = new Email($user->email,$user->name,$user->token);
                    $email->sendEmail(2);

                    //imprimir alerta
                    header('Location: '.$_ENV['HOST'].'message');
                }else{
                    User::setAlert('error','El usuario no existe o no esta confirmado');
                }
            }
        }
        $alerts = User::getAlerts();
        $router->render('auth/identify',[
            'title' => '¿Olvidaste tu Contraseña?',
            'alerts' => $alerts
        ]);
    }

    public static function recover(Router $router){
        session_start();
        isLogin();
        $alerts = [];
        $token = s($_GET['token']);
        $display = true;

        if(!$token){header('Location: '.$_ENV['HOST'].'login');}

        //encontrar al usuario
        $user = User::where('token',$token);
        if(empty($user)){
            User::setAlert('error','Token no válido');
            $display = false;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            isAdmin();
            isLogin();
            //añadir nuevo password
            $user->synchronize($_POST);

            //validar password
            $alerts = $user->validatePassword();
            $alerts = $user->validatePassword2();

            if(empty($alerts)){
                //hash
                $user->hashPassword();
                unset($user->password2); 
                //eliminar token
                $user->token = '';
                //actualizar user
                $result = $user->save($user->userId);

                if($result){
                    header('Location: '.$_ENV['HOST'].'login');
                }
            }
        }

        $alerts = User::getAlerts();
        $router->render('auth/recover',[
            'title' => 'Restablece tu contraseña',
            'alerts' => $alerts,
            'display' => $display
        ]);
    }

    public static function message(Router $router){
        session_start();
        isLogin();
        $router->render('auth/message',[
            'title' => 'Revisa tu correo'
        ]);
    }

    public static function confirm(Router $router){
        $token = s($_GET['token']);
        
        if(!$token){header('Location: '.$_ENV['HOST'].'login');}

        //encontrar al usuario
        $user = User::where('token',$token);

        if(empty($user)){
            User::setAlert('error','Token no válido, la cuenta no se confirmó');
        }else{
            //confirmar cuenta
            $user->confirm = '1';
            $user->token = '';
            $user->save($user->userId);
            
            User::setAlert('success','Cuenta confirmada correctamente');
        }

        $alerts = User::getAlerts();

        $router->render('auth/confirm',[
            'title' => 'Confirma tu cuenta UpTask',
            'alerts' => $alerts
        ]);
    }

    public static function confirm_email(Router $router){
        $token = s($_GET['token']);
        
        if(!$token){header('Location: '.$_ENV['HOST'].'login');}

        //encontrar al usuario
        $user = User::where('token',$token);
        if(empty($user)){
            User::setAlert('error','Token no válido');
        }else{
            //confirmar email
            $user->token = '';
            $user->email = $user->tempEmail;
            $user->tempEmail = '';
            $user->save($user->userId);
            User::setAlert('success','Correo actualizado correctamente');
        }

        $alerts = User::getAlerts();

        $router->render('auth/confirm-email',[
            'title' => 'Confirma tu correo de UpTask',
            'alerts' => $alerts
        ]);
    }
}