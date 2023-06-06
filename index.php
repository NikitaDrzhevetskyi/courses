<?php
include('core\Core.php');
include('core\Router.php');
include('core\DB.php');
include('config/db.php');

$router = new \core\Router();
$core = \core\Core::getInstance();

$core->init();
$router->run();

