<?php 

namespace Models;

class Category extends ActiveRecord{
    protected static $table = 'categories';
    protected static $idName = 'categoryId';
    protected static $columnsDB = ['categoryId', 'name'];

    public $categoryId;
    public $name;
}
    