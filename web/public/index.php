<?php

use app\web\core\Request;
use app\web\actions\{IndexAction, ProductAction, TonnageAction, ErrorAction};

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

if (!$request->get() || $request->get('page') === '' || $request->get('page') === 'index') {
    $index = new IndexAction();
    $response = $index->handler($request);
} elseif ($request->get('page') === 'product') {
    $product = new ProductAction();
    $response = $product->handler($request);
} elseif ($request->get('page') === 'tonnage') {
    $tonnage = new TonnageAction();
    $response = $tonnage->handler($request);
} else {
    $error = new ErrorAction();
    $response = $error->handler($request);
}

$response->send();
