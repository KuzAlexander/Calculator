<?php

class View
{
    public $layout = '@/web/views/layouts/main.php';

    public function renderPhpFile(string $path, array $params = []): string
    {
        extract($params, EXTR_OVERWRITE);
        ob_start();
        require_once getAbsolutePath($path);
        return ob_get_clean();
    }

    public function render(string $path, array $params = [], string $layout = ''): string
    {
        $layout = !empty($layout) ? $layout : $this->layout;
        $content = $this->renderPhpFile($path, $params);
        return $this->renderPhpFile($layout, ['content'=>$content]);
    }
}