<?php 

namespace Models;

class Hour extends ActiveRecord{
    protected static $table = 'hours';
    protected static $idName = 'hourId';
    protected static $columnsDB = ['hourId', 'hour'];

    public $hourId;
    public $hour;
}