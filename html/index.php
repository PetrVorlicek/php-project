<?php
  // ROUTER IMPLEMENTATION
  $request = $_SERVER['REQUEST_URI'];

  $homeDir = '/home/';
  $userDir = '/user/';

  switch ($request) {
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
    default:
      require __DIR__ .'/error/404.php';
 }
