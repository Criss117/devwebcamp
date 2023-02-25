<?php 

namespace Controllers;

use Models\Day;
use MVC\Router;
use Models\Hour;
use Models\Event;
use Models\Speaker;
use Models\Category;
use Classes\Pagination;

class EventController{
    public static function index(Router $router){
        session_start();
        isAdmin();
        isLogin();
        $alerts = [];

        $current_page = $_GET['page'];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);

        if(!$current_page || $current_page < 1){header('Location: /admin/events?page=1');}

        $records_per_page = 10;
        $total_records = Event::count();          

        $pagination = new Pagination($current_page, $records_per_page, $total_records);

        if($pagination->total_page() < $current_page){header('Location: /admin/event?page=1');}
        
        $events = Event::page($records_per_page, $pagination->offset());

        foreach($events as $event){
            $event->category = Category::find($event->categoryId);
            $event->day = Day::find($event->dayId);
            $event->hour = Hour::find($event->hourId);
            $event->speaker = Speaker::find($event->speakerId);
        }

        // Render a la vista 
        $router->render('admin/events/index', [
            'title' => 'Conferencias y WorkShops',
            'alerts' => $alerts,
            'events' => $events,
            'pagination' => $pagination->pagination()
        ]);
    }

    public static function create(Router $router){
        session_start();
        isAdmin();
        isLogin();
        $alerts = [];

        $categories = Category::all('ASC');
        $days = Day::all('ASC');
        $hours = Hour::all('ASC');
        $event = new Event;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            isAdmin();
            isLogin();
            //debuguear($_POST);
            $event->synchronize($_POST);
            //debuguear($event);
            $alerts = $event->validate();
            if(empty($alerts)){
                
                $result = $event->save($event->eventId);
                if($result){
                    header('Location: /admin/events');
                }
            }
        }

        $router->render('admin/events/create',[
            'title' => 'Conferencias y WorkShops',
            'alerts' => $alerts,
            'categories' => $categories,
            'days' => $days,
            'hours' => $hours,
            'event' => $event
        ]);
    }

    public static function update(Router $router){
        session_start();
        isAdmin();
        isLogin();
        $alerts = [];

        if(empty($_GET['id'])){header('Location: /admin/events');}

        $eventId = $_GET['id'];
        $eventId = filter_var($eventId, FILTER_VALIDATE_INT);

        $categories = Category::all('ASC');
        $days = Day::all('ASC');
        $hours = Hour::all('ASC');

        $event = Event::find($eventId);

        if(!$event){header('Location: /admin/events');}

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            isAdmin();
            isLogin();
            //debuguear($_POST);
            $event->synchronize($_POST);
            //debuguear($event);
            $alerts = $event->validate();
            if(empty($alerts)){
                
                $result = $event->save($event->eventId);
                if($result){
                    header('Location: /admin/events');
                }
            }
        }

        $router->render('admin/events/update',[
            'title' => 'editar evento',
            'alerts' => $alerts,
            'categories' => $categories,
            'days' => $days,
            'hours' => $hours,
            'event' => $event
        ]);
    }

    public static function delete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            isAdmin();
            isLogin();
            $eventId = $_POST['eventId'];
            $event = Event::find($eventId);

            if(!isset($event)){header('Location: /admin/events');}

            $result = $event->delete($event->eventId);

            if($result){
                header('Location: /admin/events');
            }
        }
    }
}