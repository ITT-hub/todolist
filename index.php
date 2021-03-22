<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/Route.php';

/*
 * Проверить маршрут
 */

$URLs  = Route::get();
$url   = ltrim(parse_url($_SERVER["REQUEST_URI"])['path'], '/');
$route = null;
if(array_key_exists($url, $URLs)) $route = $URLs[$url];
if(is_null($route)) exit ('Указанный Url не существует');

/*
 * Инициализировать контроллер
 */
$controller = "ITTech\\Controllers\\".$route;
$controller::init(__DIR__);

