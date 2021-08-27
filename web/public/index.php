<?php
    function getAbsolutePath (string $path): string
    {
        return str_replace('@', dirname(__DIR__, 2), $path);
    }

    require_once getAbsolutePath('@/web/core/Request.php');
    require_once getAbsolutePath('@/web/core/Response.php');
    require_once getAbsolutePath('@/web/core/View.php');

    $request = new Request();
    $response  = new Response();
    $view = new View();

    if (!$request->get() || $request->get('page') === '' || $request->get('page') === 'index') {

        $data = require_once(getAbsolutePath('@/data/table.php'));

        $arrMonth = $data['Month'];
        $arrProduct = $data['Product'];

        require_once (getAbsolutePath('@/web/func.php'));

        $keyArrProduct = array_keys($arrProduct);

        $product = $request->getPost('product');
        if (isset($product)) {
            $productIndex = getKeyNumber($product, $keyArrProduct);
        }

        $month = $request->getPost('month');
        if (isset($month)) {
            $monthIndex = getKeyNumber($month, $arrMonth);
        }

        $keyTonnage = array_keys($arrProduct[$keyArrProduct[0]]);
        $tonnage = $request->getPost('tonnage');
        if (isset($tonnage)) {
            $tonnageIndex = getKeyNumber($tonnage, $keyTonnage);
        }

        $content = $view->renderPhpFile('@/web/views/index.php', [
            'keyArrProduct' => $keyArrProduct,
            'arrMonth' => $arrMonth,
            'keyTonnage' => $keyTonnage,
            'arrProduct' => $arrProduct,
            'productIndex' => $productIndex,
            'monthIndex' => $monthIndex,
            'tonnageIndex' => $tonnageIndex,
            'request' => $request,
        ]);
    } else {
        $errorMassage = '404 Страница не найдена';
        $response->setStatusCode(404, 'Not Found');
        $content = $view->renderPhpFile('@/web/views/error.php', ['errorMassage' => $errorMassage]);
    }

    $response->setContent($content);
    $response->send();


