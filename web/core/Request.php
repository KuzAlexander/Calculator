<?php

class Request
{
    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isPost(): bool
    {
        return $this->getRequestMethod() === 'POST';
    }

    // переделать как get()
    public function getPost(string $key = '', $default = null)
    {
        if ($this->isPost() && $key !== ''){
            return $_POST[$key] !== '' ? $_POST[$key] : $default;
        } else {
            return $_POST;
        }
    }

    public function isGet(): bool
    {
        return $this->getRequestMethod() === 'GET';
    }

    public function get(string $key = '', $default = null)
    {
        if ($key !== '') {
            return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
//            return $_GET[$key] ?? $default;
        } else {
            return $_GET;
        }
//        return $key !== '' ? ($_GET[$key] ?? $default) : $_GET;
    }
}
