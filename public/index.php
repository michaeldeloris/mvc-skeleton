<?php

use App\Http\Response;

require __DIR__ . '/../vendor/autoload.php';

$content = file_get_contents(__DIR__ . '/../config/route.json');
$routes = json_decode($content);
$uri = $_SERVER['REDIRECT_URL'];
$method = strtolower($_SERVER['REQUEST_METHOD']);
$prefix = "App\\Controller\\";
$response = new Response();
$match = [];

foreach ($routes as $route) {
    $pattern = "/" . str_replace("/", "\/", $route->path) . "$/";
    if ($method === $route->method
        && preg_match($pattern, $uri, $match)) {
        $className = $prefix . $route->controller;
        $controller = new $className($response);
        array_shift($match);
        $response = $controller->{$route->action}(...$match);
    }
}
if (!$response) {
    throw new Exception("Response required");
}

if (!isset($controller)) {

    $response->setStatus(404, "Not found");
    $response->setBody("No route found for path " . $uri);
}

header("HTTP/1.1 " . $response->getStatusCode() . " " . $response->getStatusText());
foreach ($response->getHeader() as $key => $value) {
    header($key . ": " . $value);
}
echo $response->getBody();
