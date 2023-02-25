<?php

namespace Models;

class Speaker extends ActiveRecord{
    protected static $table = 'speakers';
    protected static $idName = 'speakerId';
    protected static $columnsDB = ['speakerId','name','surname','city','country','image','tags','network','active'];

    public $speakerId;
    public $name;
    public $surname;
    public $city;
    public $country;
    public $image;
    public $tags;
    public $network;
    public $active;

    public function __construct($args = [])
    {
        $this->speakerId = $args['speakerId'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->network = $args['network'] ?? '';
        $this->active = $args['active'] ?? '1';
    }

    public function validate(){
        if(!$this->name){
            self::$alerts['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->surname){
            self::$alerts['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->city){
            self::$alerts['error'][] = 'El campo ciudad es obligatorio';
        }
        if(!$this->country){
            self::$alerts['error'][] = 'El campo país es obligatorio';
        }
        if(!$this->image){
            self::$alerts['error'][] = 'La imagen es obligatoria';
        }
        if(!$this->tags){
            self::$alerts['error'][] = 'El campo áreas es obligatorio';
        }
        return self::$alerts;
    }
}