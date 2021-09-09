<?php

use app\web\core\Request;
use app\web\actions\{ActionIndex, ActionProduct, ActionTonnage, ActionErrorPage};

function getAbsolutePath (string $path): string
{
    return str_replace('@', dirname(__DIR__, 2), $path);
}

function autoloader($class)
{
    $class = str_replace(["\\", 'app'], ['/', ''], $class);
    $file = getAbsolutePath("@{$class}.php");
    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('autoloader');

$request = new Request();
$index = new ActionIndex();
$product = new ActionProduct();
$tonnage = new ActionTonnage();
$error = new ActionErrorPage();

if (!$request->get() || $request->get('page') === '' || $request->get('page') === 'index') {
    $response = $index->handler($request);
} elseif ($request->get('page') === 'product') {
    $response = $product->handler($request);
} elseif ($request->get('page') === 'tonnage') {
    $response = $tonnage->handler($request);
} else {
    $response = $error->handler($request);
}

$response->send();
