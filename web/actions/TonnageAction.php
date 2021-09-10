<?php
namespace app\web\actions;

use app\web\core\{Response, View, Request};

class TonnageAction
{
    public string $content;

    public function handler(Request $request): Response
    {
        $response  = new Response();
        $view = new View();

        $data = require_once(getAbsolutePath('@/data/table.php'));
        $arrProduct = $data['Product'];
        $keyArrProduct = array_keys($arrProduct);
        $keyTonnage = array_keys($arrProduct[$keyArrProduct[0]]);
        $tonnage = 'Тоннаж:';

        $this->content = $view->render('@/web/views/tonnage.php', [
            'tonnage' => $tonnage,
            'keyTonnage' => $keyTonnage,
            'request' => $request,
        ]);

        $response->setContent($this->content);

        return $response;
    }
}