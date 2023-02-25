<?php 

namespace Models;

class Day extends ActiveRecord{
    protected static $table = 'days';
    protected static $idName = 'dayId';
    protected static $columnsDB = ['dayId', 'name'];

    public $dayId;
    public $name;
}