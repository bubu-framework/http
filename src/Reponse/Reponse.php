<?php

namespace Bubu\Http\Reponse;

class Reponse
{
    use DefaultHttpReponse;

    private int    $httpCode    = 200;
    private string $message     = 'OK';
    private float  $httpVersion = 1.1;
    private array  $headers     = [];
    private string $content     = '';

    public function setHttpCode(int $code): self
    {
        $this->httpCode = $code;
        return $this;
    }

    public function setHttpMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function createHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function deleteHeader(string $name): self
    {
        unset($this->headers[$name]);
        return $this;
    }

    public function setup(): self
    {
        header("HTTP/{$this->httpVersion} {$this->httpCode} {$this->message}");
        http_response_code($this->httpCode);
        foreach ($this->headers as $key => $value) {
            header("{$key}: {$value}");
        }
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function send(): void
    {
        echo $this->content;
    }
}
