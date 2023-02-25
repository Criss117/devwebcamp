<?php

namespace Models;

class Gift extends ActiveRecord{
    protected static $table = 'gifts';
    protected static $idName = 'giftId';
    protected static $columnsDB = ['giftId','name'];

    public $giftId;
    public $name;

    public function __construct($args = [])
    {
        $this->giftId = $args['giftId'] ?? null;
        $this->name = $args['name'] ?? '';
    }    
}