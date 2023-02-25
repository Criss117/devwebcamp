<?php 

namespace Controllers;

use Classes\Pagination;
use Models\Event;
use MVC\Router;
use Models\Day;
use Models\Hour;
use Models\Speaker;
use Models\Category;


class PageController{
    public static function index(Router $router){
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

        //obtener total
        $totalSpeakers = Speaker::count();
        $totalConferences = Event::count('categoryId', '1');
        $totalWorkshops = Event::count('categoryId', '2');

        //obtener todos los ponentes
        $speakers = Speaker::all();

        $router->render('pages/index', [
            'title' => 'Conferencias & WorkShops',
            'events' => $formatted_events,
            'totalSpeakers' => $totalSpeakers,
            'totalConferences' => $totalConferences,
            'totalWorkshops' => $totalWorkshops,
            'speakers' => $speakers
        ]);
    }
    
    public static function events(Router $router){
        
        $router->render('/pages/devwebcamp', [
            'title' => 'Sobre DevWebCamp'
        ]);
    }

    public static function packages(Router $router){
        
        $router->render('pages/packages', [
            'title' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferences(Router $router){
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
        $router->render('pages/conferences', [
            'title' => 'Conferencias & WorkShops',
            'events' => $formatted_events
        ]);
    }
    public static function error(Router $router){   
        $router->render('pages/error', [
            'title' => 'Página no encontrada'
        ]);
    }
}

