<?php
    function getAbsolutePath (string $path): string
    {
        return str_replace('@', dirname(__DIR__, 2), $path);
    }

    function autoloader($class)
    {
        $class = str_replace(["\\", 'app'], ['/', ''], $class);
        $file = dirname(__DIR__, 2) . "/{$class}.php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
    spl_autoload_register('autoloader');

    $request = new \app\web\core\Request();
    $response  = new \app\web\core\Response();
    $view = new \app\web\core\View();

    $data = require_once(getAbsolutePath('@/data/table.php'));
    $arrMonth = $data['Month'];
    $arrProduct = $data['Product'];
    $keyArrProduct = array_keys($arrProduct);
    $keyTonnage = array_keys($arrProduct[$keyArrProduct[0]]);

    if (!$request->get() || $request->get('page') === '' || $request->get('page') === 'index') {

        require_once (getAbsolutePath('@/web/func.php'));

        $product = $request->getPost('product');
        if (isset($product)) {
            $productIndex = getKeyNumber($product, $keyArrProduct);
        }

        $month = $request->getPost('month');
        if (isset($month)) {
            $monthIndex = getKeyNumber($month, $arrMonth);
        }

        $tonnage = $request->getPost('tonnage');
        if (isset($tonnage)) {
            $tonnageIndex = getKeyNumber($tonnage, $keyTonnage);
        }

        $content = $view->render('@/web/views/index.php', [
            'keyArrProduct' => $keyArrProduct,
            'arrMonth' => $arrMonth,
            'keyTonnage' => $keyTonnage,
            'arrProduct' => $arrProduct,
            'productIndex' => $productIndex,
            'monthIndex' => $monthIndex,
            'tonnageIndex' => $tonnageIndex,
            'request' => $request,
        ]);
    } elseif ($request->get('page') === 'product') {
        $products = 'Продукты:';
        $content = $view->render('@/web/views/product.php', [
            'keyArrProduct' => $keyArrProduct,
            'products' => $products,
            'request' => $request,
        ]);
    } elseif ($request->get('page') === 'tonnage') {
        $tonnage = 'Тоннаж:';
        $content = $view->render('@/web/views/tonnage.php', [
            'keyTonnage' => $keyTonnage,
            'tonnage' => $tonnage,
            'request' => $request,
        ]);
    } else {
        $errorMassage = '404 Страница не найдена';
        $response->setStatusCode(404, 'Not Found');
        $view->layout = '@/web/views/layouts/error.php';
        $content = $view->render('@/web/views/error.php', [
            'errorMassage' => $errorMassage,
            'request' => $request
        ]);
    }

    $response->setContent($content);
    $response->send();
