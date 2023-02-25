<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIEvents;
use Controllers\APIGifts;
use Controllers\APISpeaker;
use Controllers\AuthController;
use Controllers\GiftController;
use Controllers\PageController;
use Controllers\EventController;
use Controllers\SpeakerController;
use Controllers\RegisterController;
use Controllers\DashboardController;
use Controllers\FRegisterController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/create', [AuthController::class, 'create']);
$router->post('/create', [AuthController::class, 'create']);

// Formulario de olvide mi password
$router->get('/identify', [AuthController::class, 'identify']);
$router->post('/identify', [AuthController::class, 'identify']);

// Colocar el nuevo password
$router->get('/recover', [AuthController::class, 'recover']);
$router->post('/recover', [AuthController::class, 'recover']);

// Confirmación de Cuenta
$router->get('/message', [AuthController::class, 'message']);
$router->get('/confirm', [AuthController::class, 'confirm']);

//area de administracion
$router->get('/admin/dashboard',[DashboardController::class, 'index']);

//speakers
$router->get('/admin/speakers',[SpeakerController::class, 'index']);

$router->get('/admin/speakers/create',[SpeakerController::class, 'create']);
$router->post('/admin/speakers/create',[SpeakerController::class, 'create']);

$router->get('/admin/speakers/update',[SpeakerController::class, 'update']);
$router->post('/admin/speakers/update',[SpeakerController::class, 'update']);

$router->post('/admin/speakers/delete',[SpeakerController::class, 'delete']);

//events
$router->get('/admin/events',[EventController::class, 'index']);
//crear evento
$router->get('/admin/events/create',[EventController::class, 'create']);
$router->post('/admin/events/create',[EventController::class, 'create']);

$router->get('/admin/events/update',[EventController::class, 'update']);
$router->post('/admin/events/update',[EventController::class, 'update']);

$router->post('/admin/events/delete',[EventController::class, 'delete']);

//registered
$router->get('/admin/register',[RegisterController::class, 'index']);

//gifts
$router->get('/admin/gifts',[GiftController::class, 'index']);

//API
$router->get('/api/event-schedule',[APIEvents::class,'index']);

$router->get('/api/speakers',[APISpeaker::class,'index']);
$router->get('/api/speaker',[APISpeaker::class,'speaker']);
$router->get('/api/gift',[APIGifts::class,'index']);

//registro de usuarios
$router->get('/finish-registration',[FRegisterController::class, 'create']);
$router->post('/finish-registration/free',[FRegisterController::class, 'free']);
$router->post('/finish-registration/pay',[FRegisterController::class, 'pay']);
$router->get('/finish-registration/conferences',[FRegisterController::class, 'conferences']);
$router->post('/finish-registration/conferences',[FRegisterController::class, 'conferences']);

//boleto virtual
$router->get('/ticket',[FRegisterController::class, 'ticket']);


//area publica
$router->get('/',[PageController::class, 'index']);
$router->get('/devwebcamp',[PageController::class, 'events']);
$router->get('/packages',[PageController::class, 'packages']);
$router->get('/workshops-conferences',[PageController::class, 'conferences']);

$router->get('/404',[PageController::class, 'error']);

$router->checkRoutes();