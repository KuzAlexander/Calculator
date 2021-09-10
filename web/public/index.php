<?php

use app\web\core\{Request, Response};
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

function includePage(Request $request): Response
{
    $page = $request->get('page');
    $path = getAbsolutePath('@/web/actions');

    $name = 'ErrorAction';
    foreach(glob($path . '/*') as $file) {
        if(file_exists($file)) {
            $longName = str_replace('.php', '', basename($file));
            $shortName = lcfirst(str_replace('Action', '', $longName));

            if ($page === $shortName) {
                $name = $longName;
            } elseif ($page === '' || !$request->get()) {
                $name = 'IndexAction';
            }
        }
    }

    $className = "\app\web\actions\\$name";
    $obj = new $className();

    return $obj->handler($request);
}

includePage($request)->send();
