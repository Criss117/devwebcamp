<?php

namespace Models;

class EventRegister extends ActiveRecord{
    protected static $table = 'events_register';
    protected static $idName = 'event_registerId';
    protected static $columnsDB = ['event_registerId','eventId','registerId'];

    public $event_registerId;
    public $eventId;
    public $registerId;

    public function __construct($args = [])
    {
        $this->event_registerId = $args['event_registerId'] ?? null;
        $this->eventId = $args['eventId'] ?? '';
        $this->registerId = $args['registerId'] ?? '';
    }    
}