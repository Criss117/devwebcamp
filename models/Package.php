<?php

namespace Models;

class Package extends ActiveRecord{
    protected static $table = 'packages';
    protected static $idName = 'packageId';
    protected static $columnsDB = ['packageId','name'];

    public $packageId;
    public $name;
}