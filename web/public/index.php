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
    $name = namePage($request, arrayNamePage());
    $className = "\app\web\actions\\$name";
    $pageAction = new $className();

    return $pageAction->handler($request);
}

function arrayNamePage(): array
{
    $path = getAbsolutePath('@/web/actions');
    $namesPage = [];
    foreach(glob($path . '/*') as $file) {
        if(file_exists($file)) {
            $longName = str_replace('.php', '', basename($file));
            $shortName = lcfirst(str_replace('Action', '', $longName));
            $namesPage[$shortName] = $longName;
        }
    }
    return $namesPage;
}

function namePage(Request $request, array $namesPage): string
{
    $page = $request->get('page');
    $name = 'ErrorAction';

    foreach($namesPage as $shorName => $longName)
    if ($page === $shorName) {
        $name = $longName;
    } elseif ($page === '' || !$request->get()) {
        $name = 'IndexAction';
    }
    return $name;
}

includePage($request)->send();
