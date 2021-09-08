<?php
namespace app\web\core;

class Response
{
    private string $content;

    public function setStatusCode(int $code, string $phrase): void
    {
        header("HTTP/1.1 $code $phrase");
    }

    public function addHeader(string $name, string $value): void
    {
        header("$name: $value");
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function send(): void
    {
        echo $this->content;
        exit;
    }
}
