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

    /**
     * Set the http code
     *
     * @param integer $code
     * @return self
     */
    public function setHttpCode(int $code): self
    {
        $this->httpCode = $code;
        return $this;
    }

    /**
     * Put a http message
     *
     * @param string $message
     * @return self
     */
    public function setHttpMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Add personalized header
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function createHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Delete a header
     *
     * @param string $name
     * @return self
     */
    public function deleteHeader(string $name): self
    {
        unset($this->headers[$name]);
        return $this;
    }

    /**
     * Setup the registred header
     *
     * @return self
     */
    public function setup(): self
    {
        header("HTTP/{$this->httpVersion} {$this->httpCode} {$this->message}");
        http_response_code($this->httpCode);
        foreach ($this->headers as $key => $value) {
            header("{$key}: {$value}");
        }
        return $this;
    }

    /**
     * Set content of page
     *
     * @param string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * send content of page
     *
     * @return void
     */
    public function send(): void
    {
        echo $this->content;
    }
}
