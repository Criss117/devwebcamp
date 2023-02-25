<?php 

namespace Models;

class Event extends ActiveRecord{
    protected static $table = 'events';
    protected static $idName = 'eventId';
    protected static $columnsDB = ['eventId', 'name','description','available','categoryId','dayId','hourId','speakerId'];

    public $eventId;
    public $name;
    public $description;
    public $available;
    public $categoryId;
    public $dayId;
    public $hourId;
    public $speakerId;

    public function __construct($args = [])
    {
        $this->eventId = $args['enventId'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->available = $args['available'] ?? '';
        $this->categoryId = $args['categoryId'] ?? null;
        $this->dayId = $args['day'] ?? null;
        $this->hourId = $args['hourId'] ?? null;
        $this->speakerId = $args['speakerId'] ?? null;
    }

    // Mensajes de validación para la creación de un evento
    public function validate() {
        if(!$this->name) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->description) {
            self::$alerts['error'][] = 'La descripción es Obligatoria';
        }
        if(!$this->categoryId  || !filter_var($this->categoryId, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige una Categoría';
        }
        if(!$this->dayId  || !filter_var($this->dayId, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige el Día del evento';
        }
        if(!$this->hourId  || !filter_var($this->hourId, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige la hora del evento';
        }
        if(!$this->available  || !filter_var($this->available, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Añade una cantidad de Lugares Disponibles';
        }
        if(!$this->speakerId || !filter_var($this->speakerId, FILTER_VALIDATE_INT) ) {
            self::$alerts['error'][] = 'Selecciona la persona encargada del evento';
        }

        return self::$alerts;
    }

}