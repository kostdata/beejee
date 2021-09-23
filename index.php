<?php
define( '_APP_EXEC', 1 );
session_start();
$appConfig = require __DIR__ . '/config/application.config.php';
require __DIR__ . '/include/autoload.php';
$routeAction = $_SERVER["REQUEST_URI"];
if (isset($_GET['action'])) {
    $routeAction = $_GET['action'];
}

switch ($routeAction) {
   
    case 'login':
        $controllerName = 'AuthController';
        $action = 'loginAction';
        break;


    
    case 'loginsubmitted':
        $controllerName = 'AuthController';
        $action = 'loginsubmittedAction';
        break;

    case 'logout':
        $controllerName = 'AuthController';
        $action = 'logoutAction';
        break;

    case 'admincheck':
        $controllerName = 'TaskController';
        $action = 'checkAction';
    break ;
    case 'savetask':
        $controllerName = 'TaskController';
        $action = 'saveAction';
    break ;
    case 'add':
    case 'edit':
        $controllerName = 'TaskController';
        $action = 'addAction';
    break ;
    case 'list':
    default:
        $controllerName = 'TaskController';
        $action = 'indexAction';
        break;
}
$db = new DbConnectionManager($appConfig);
$dbConnection = null;
if ($db) {
    $dbConnection = $db->getConnection();
}


$TaskModel = new TaskModel($dbConnection);

$controller = new $controllerName($TaskModel);
$controller->{$action}($_REQUEST);