<?php

declare(strict_types=1);

require('../vendor/autoload.php');

define('TEMPLATES_DIR', __DIR__ . '/../templates/');
define('SRC_DIR', __DIR__ . '/');
define('PUBLIC_DIR', __DIR__ . '/../public/');

$routes = [
    '/report-creator' => [
        'GET' => 'App\Controller\ReportCreatorController@show',
        'POST' => 'App\Controller\ReportCreatorController@execute'
    ],
    '/bulk-report' => [
        'GET' => 'App\Controller\BulkReportController@show',
        'POST' => 'App\Controller\BulkReportController@execute'
    ]
];

$path = $_SERVER['PATH_INFO'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    if (!array_key_exists($path, $routes)) {
        throw new RuntimeException(
            "La page correspondant à l'URL `$path` n'existe pas, 
            corrigez le tableau des routes ou l'URL dans votre barre d'adresse"
        );
    }

    $route = $routes[$path];
    [$className, $methodName] = getControllerForRoute($route, $method);

    if (!class_exists($className)) {
        throw new RuntimeException(
            "La classe <strong>$className</strong> n'existe pas et ne peut donc pas répondre à cette route ! 
                        Vous devriez construire cette classe ou alors corriger vos routes !"
        );
    }

    $controller = new $className();

    if (!method_exists($controller, $methodName)) {
        throw new RuntimeException(
            "La classe <strong>$className</strong> n'a aucune méthode <strong>$methodName</strong> ! 
                        Vous devriez créer cette méthode ou corriger vos routes !"
        );
    }

    $controller->$methodName();
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require(TEMPLATES_DIR . "error.html.php");
}

function getControllerForRoute(array $route, string $httpMethod = 'GET'): array
{
    $controller = $route[$httpMethod];
    $className = substr($controller, 0, strpos($controller, '@'));
    $methodName = substr($controller, strpos($controller, '@') + 1);

    return [$className, $methodName];
}
