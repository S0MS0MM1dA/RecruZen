<?php
  require_once __DIR__ . '/app/controllers/PageHandler.php';

$page = $_GET['page'] ?? 'home';
PageHandler::load($page);

?>