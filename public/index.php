<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\AppointmentController;

$router = new Router();

$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/crear-cuenta', [LoginController::class, 'createAccount']);
$router->post('/crear-cuenta', [LoginController::class, 'createAccount']);

$router->get('/confirmar-cuenta', [LoginController::class, 'confirmAccount']);
$router->get('/mensaje', [LoginController::class, 'message']);

$router->get('/olvide', [LoginController::class, 'forgotPassword']);
$router->post('/olvide', [LoginController::class, 'forgotPassword']);
$router->get('/recuperar', [LoginController::class, 'resetPassword']);
$router->post('/recuperar', [LoginController::class, 'resetPassword']);

$router->get('/cita', [AppointmentController::class, 'index']);

$router->checkRoutes();
