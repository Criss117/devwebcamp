<?php 

namespace Controllers;

use Models\Day;
use MVC\Router;
use Models\Hour;
use Models\User;
use Models\Event;
use Models\Package;
use Models\Speaker;
use Models\Category;
use Models\EventRegister;
use Models\Gift;
use Models\Register;


class FRegisterController{
    public static function create(Router $router){
        session_start();
        isLogin();
        //verificar si el usuario ya está reditrado
        $register = Register::where('userId', $_SESSION['userId']);

        if(isset($register) && ($register->packageId === '3' || $register->packageId === '2')){   
            header('Location: /ticket?id=' . urlencode($register->token));
            return;
        }

        if(isset($register) && $register->packageId === "1"){
            header('Location: /finish-registration/conferences');
            return;
        }

        // Render a la vista 
        $router->render('register/create', [
            'title' => 'Finalizar registro'
        ]);
    }

    public static function free(){   
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            isLogin();

            if(isset($register) && $register->packageId === '3'){   
                header('Location: /ticket?id=' . urlencode($register->token));
                return;
            }
            
            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            $data = [
                'packageId' => 3,
                'payId' => '',
                'token' => $token,
                'userId' => $_SESSION['userId']
            ];

            $register = new Register($data);

            $result = $register->save($register->registerId);

            if($result){
                header('Location: /ticket?id=' . urlencode($register->token));
                return;
            }
        }
    }

    public static function ticket(Router $router){ 
        session_start();
        isLogin();
        $id = $_GET['id'];
        
        if(!$id || !strlen($id) === 8){header('Location: /');return;}
        

        $register = Register::where('token', $id);

        if(!$register){header('Location: /');return;}
        

        //llenar las tablas de referencia
        $register->user = User::find($register->userId);
        $register->package = Package::find($register->packageId);

        $router->render('register/ticket', [
            'title' => 'Asistencia a DevWebCamp',
            'register' => $register
        ]);
    }

    public static function pay(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            isLogin();
            if(empty($_POST)){
                echo json_encode([]);
                return;
            }
            $data = $_POST;
            $data['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $data['userId'] = $_SESSION['userId'];
            try {
                $register = new Register($data);
                $result = $register->save($register->registerId);

                echo json_encode($result);
            } catch (\Throwable $th) {
                echo json_encode([
                    'result' => 'error' 
               ]);
            }
        }
    }

    public static function conferences(Router $router){ 
        session_start();
        isLogin();

        //validar plan presencial
        $userId = $_SESSION['userId'];
        $register = Register::where('userId',$userId);
        
        if(isset($register) && $register->packageId === "2"){
            header('Location: /ticket?id=' . urlencode($register->token));
            return;
        }

        if($register->packageId !== "1"){
            header('location: /');
            return;
        }

        $events_register = EventRegister::where('registerId',$register->registerId);
        if(isset($events_register)){
            header('Location: /ticket?id=' . urlencode($register->token));
            return;
        }

        $events = Event::orderby('hourId','ASC');
        $formatted_events = [];
        foreach($events as $event){
            $event->category = Category::find($event->categoryId);
            $event->day = Day::find($event->dayId);
            $event->hour = Hour::find($event->hourId);
            $event->speaker = Speaker::find($event->speakerId);

            if($event->dayId === "1" && $event->categoryId === "1"){
                $formatted_events['conferences_friday'][] = $event;
            }
            if($event->dayId === "2" && $event->categoryId === "1"){
                $formatted_events['conferences_saturday'][] = $event;
            }
            if($event->dayId === "1" && $event->categoryId === "2"){
                $formatted_events['workshops_friday'][] = $event;
            }
            if($event->dayId === "2" && $event->categoryId === "2"){
                $formatted_events['workshops_saturday'][] = $event;
            }
        }

        $gifts = Gift::all('ASC');

        //manejando el registro mediante $POST

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            isLogin();

            $events = explode(',',$_POST['events']);
            if(empty($events)){
                echo json_encode(['result' => false]);
                return;
            }

            $register = Register::where('userId',$_SESSION['userId']);
            if(!isset($register) || $register->packageId !== "1"){
                echo json_encode(['result' => false]);
                return;
            }
            $eventsArray = [];
            //validar disponibilad de los eventos
            foreach($events as $eventId){
                $event = Event::find($eventId);
                if(!isset($event) || $event->available === "0"){
                    echo json_encode(['result' => false]);
                    return;
                }
                $eventsArray[] = $event;
            }
            foreach($eventsArray as $event){
                $event->available -= 1;
                $event->save($event->eventId);

                //almacenar registros
                $data = [
                    'eventId' => (int) $event->eventId,
                    'registerId' => (int) $register->registerId
                ];
                $user_register = new EventRegister($data);
                $user_register->save($user_register->event_registerId);

                $register->synchronize(['giftId' => $_POST['giftId']]);
                $result = $register->save($register->registerId);
                if($result){
                    echo json_encode([
                        'result' => $result, 
                        'token' => $register->token]);
                }else{
                    echo json_encode(['result' => false]);
                }
                return;
            }
        }

        $router->render('register/conferences', [
            'title' => 'Elige WorkShops & Conferencias',
            'events' => $formatted_events,
            'gifts' => $gifts
        ]);
    }
}