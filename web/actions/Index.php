<?php
namespace app\web\actions;

use app\web\core\{Request, Response, View};

class Index
{
    public string $content;

    public function handler(Request $request): Response
    {
        $response  = new Response();
        $view = new View();

        require_once (getAbsolutePath('@/web/func.php'));
        $data = require_once(getAbsolutePath('@/data/table.php'));
        $arrMonth = $data['Month'];
        $arrProduct = $data['Product'];
        $keyArrProduct = array_keys($arrProduct);
        $keyTonnage = array_keys($arrProduct[$keyArrProduct[0]]);

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

        $this->content = $view->render('@/web/views/index.php', [
            'keyArrProduct' => $keyArrProduct,
            'arrMonth' => $arrMonth,
            'keyTonnage' => $keyTonnage,
            'arrProduct' => $arrProduct,
            'productIndex' => $productIndex,
            'monthIndex' => $monthIndex,
            'tonnageIndex' => $tonnageIndex,
            'request' => $request,
        ]);

        $response->setContent($this->content);

        return $response;
    }
}