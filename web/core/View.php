<?php

class View
{
    public function renderPhpFile(string $path, array $params = []): string
    {
        extract($params, EXTR_OVERWRITE);
        ob_start();
        require_once str_replace('@', dirname(__DIR__, 2), $path);
        return ob_get_clean();
    }

    public function render(string $content, string $path = '@/web/views/layouts/main.php'): string
    {
        $params['content'] = $content;
        return $this->renderPhpFile($path, $params);
    }
}