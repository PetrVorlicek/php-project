<?php
  // ROUTER IMPLEMENTATION
  require __DIR__ . "/static/php/dbConnector.php";
  $request = $_SERVER['REQUEST_URI'];
  $parsed_request = parse_url($request);
  $path = $parsed_request['path'];

  $homeDir = '/home/';
  $userDir = '/user/';

  switch ($path) {
    case '':
    case '/':
       require __DIR__ . $homeDir . 'home.php';
       break;
    case '/about':
      require __DIR__ . $homeDir . 'about.php';
      break;
    case '/login':
      require __DIR__ . $userDir . 'login.php';
      break;
    case '/register':
      require __DIR__ . $userDir . 'register.php';
      break;
    case '/homepage':
      require __DIR__ . $userDir . 'homepage.php';
      break;
    case '/settings':
      require __DIR__ . $userDir . 'settings.php';
      break;
    case '/play':
      require __DIR__ . '/game/game.php';
      break;
    case '/add':
      require __DIR__ . $userDir . 'addA.php';
      break;
    case '/addB':
      require __DIR__ . $userDir . 'addB.php';
      break;
    case '/error':
      require __DIR__ . '/error/error.php';
      break;
    default:
      require __DIR__ .'/error/404.php';
      break;
 }
