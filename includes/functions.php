<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function debuguears($variable) : void {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado

function isAdmin() : void {
    if(!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
        header('Location: /login');
    }
}

function is_admin() : bool{
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function isAuth(): bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['name']) && !empty($_SESSION);
}

function isLogin() : void {
    if(empty($_SESSION)) {
        header('Location: /login');
    }
}

function actual_page($path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path  ) ? true : false;
}

function aos_animation() : void{
    $efects = ['fade-up', 'fade-down','fade-ledft', 'fade-right', 'flip-left', 'flit-right','zoom-in','zoom-in-up','zoom-in-down'];
    $efect = array_rand($efects);

    echo ' data-aos="'. $efects[$efect].'" ';
}