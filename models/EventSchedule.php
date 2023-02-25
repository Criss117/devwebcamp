<?php 

namespace Models;

class EventSchedule extends ActiveRecord{
    protected static $table = 'events';
    protected static $idName = 'eventId';
    protected static $columnsDB = ['eventId', 'categoryId','dayId','hourId'];

    public $eventId;
    public $categoryId;
    public $dayId;
    public $hourId;
}
    