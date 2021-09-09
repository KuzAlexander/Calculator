<?php
namespace app\web\actions;

use app\web\core\{View, Request, Response};

class ErrorPage
{
    public string $content;

    public function handler(Request $request): Response
    {
        $response  = new Response();
        $view = new View('@/web/views/layouts/error.php');

        $errorMassage = '404 Страница не найдена';
        $response->setStatusCode(404, 'Not Found');
        $this->content = $view->render('@/web/views/error.php', [
            'errorMassage' => $errorMassage,
            'request' => $request
        ]);

        $response->setContent($this->content);

        return $response;
    }
}