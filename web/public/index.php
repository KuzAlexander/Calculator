<?php

use app\web\core\{Request};
use app\web\actions\{Index, Product, Tonnage, ErrorPage};

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
$index = new Index();
$product = new Product();
$tonnage = new Tonnage();
$error = new ErrorPage();

if (!$request->get() || $request->get('page') === '' || $request->get('page') === 'index') {
    $response = $index->handler($request);
    $content = $index->content;
} elseif ($request->get('page') === 'product') {
    $response = $product->handler($request);
    $content = $product->content;
} elseif ($request->get('page') === 'tonnage') {
    $response = $tonnage->handler($request);
    $content = $tonnage->content;
} else {
    $response = $error->handler($request);
    $content = $error->content;
}

$response->setContent($content);
$response->send();
