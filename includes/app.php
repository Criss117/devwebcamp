<?php 

use Dotenv\Dotenv;
use Models\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

// Añadir Dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';




// Conectarnos a la base de datos
ActiveRecord::setDB($db);