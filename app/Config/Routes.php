<?php

use App\Controllers\Auth;
use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login', [Auth::class, 'login']);
$routes->post('/login', [Auth::class, 'postLogin']);

$routes->get('/signin', [Auth::class, 'signin']);
$routes->post('/signin', [Auth::class, 'postSignin']);

$routes->get('/logout', [Auth::class, 'logout']);

$routes->get('/forgot-password', [Auth::class, 'forgotPassword']);
$routes->post('/forgot-password', [Auth::class, 'postForgotPassword']);

$routes->get('/recover-password', [Auth::class, 'recoverPassword']);
$routes->post('/recover-password', [Auth::class, 'postRecoverPassword']);

$routes->get('/', [Home::class, 'index']);
