<?php 

namespace Controllers;

use Models\EventSchedule;

class APIEvents{
    public static function index(){
        $dayId = $_GET['dayId'] ?? '';
        $categoryId = $_GET['categoryId'] ?? '';

        $dayId = filter_var($dayId, FILTER_VALIDATE_INT);    
        $categoryId = filter_var($categoryId, FILTER_VALIDATE_INT);    
    
        if(!$dayId || !$categoryId){
            echo json_encode([]);
            return;
        }

        $events = EventSchedule::whereArray(['dayId' => $dayId,'categoryId' => $categoryId]) ?? '';

        echo json_encode($events);
        //consultar base de datos
    }
}