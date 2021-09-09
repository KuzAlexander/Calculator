<?php
namespace app\web\actions;

use app\web\core\{View, Request, Response};

class ActionProduct
{
    public string $content;

    public function handler(Request $request): Response
    {
        $response  = new Response();
        $view = new View();

        $data = require_once(getAbsolutePath('@/data/table.php'));
        $arrProduct = $data['Product'];
        $keyArrProduct = array_keys($arrProduct);
        $products = 'Продукты:';

        $this->content = $view->render('@/web/views/product.php', [
            'products' => $products,
            'keyArrProduct' => $keyArrProduct,
            'request' => $request,
        ]);

        $response->setContent($this->content);

        return $response;
    }
}