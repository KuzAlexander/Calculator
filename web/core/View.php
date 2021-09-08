<?php
namespace app\web\core;

class View
{
    public string $layout = '@/web/views/layouts/main.php';

    public function __construct(string $layout = '')
    {
        $this->layout = !empty($layout) ? $layout : $this->layout;
    }

    public function renderPhpFile(string $path, array $params = []): string
    {
        extract($params, EXTR_OVERWRITE);
        ob_start();
        require_once getAbsolutePath($path);
        return ob_get_clean();
    }

    public function render(string $path, array $params = []): string
    {
        $content = $this->renderPhpFile($path, $params);
        return $this->renderPhpFile($this->layout, ['content'=>$content]);
    }
}