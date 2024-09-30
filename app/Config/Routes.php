<?php

use App\Controllers\Auth;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login', [Auth::class, 'login']);

$routes->get('/signin', [Auth::class, 'signin']);
$routes->post('/signin', [Auth::class, 'postSignin']);

$routes->get('/forgot-password', [Auth::class, 'forgotPassword']);

$routes->get('/', 'Home::index');
