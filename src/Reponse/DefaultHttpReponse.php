<?php

namespace Bubu\Http\Reponse;

trait DefaultHttpReponse
{

    // 200

    public function reponse200(): self
    {
        $this->httpCode = 200;
        $this->message  = 'OK';
        return $this;
    }

    public function reponse201(): self
    {
        $this->httpCode = 201;
        $this->message  = 'CREATED';
        return $this;
    }

    public function reponse202(): self
    {
        $this->httpCode = 202;
        $this->message  = 'ACCEPTED';
        return $this;
    }

    public function reponse206(): self
    {
        $this->httpCode = 206;
        $this->message  = 'Partial Content';
        return $this;
    }


    // 300

    public function reponse301(): self
    {
        $this->httpCode = 301;
        $this->message  = 'Moved Permanently';
        return $this;
    }

    public function reponse302(): self
    {
        $this->httpCode = 302;
        $this->message  = 'Found';
        return $this;
    }

    public function reponse304(): self
    {
        $this->httpCode = 304;
        $this->message  = 'Not Modified';
        return $this;
    }


    // 400

    public function reponse400(): self
    {
        $this->httpCode = 400;
        $this->message  = 'Bad Request';
        return $this;
    }

    public function reponse401(): self
    {
        $this->httpCode = 401;
        $this->message  = 'Unauthorized';
        return $this;
    }

    public function reponse402(): self
    {
        $this->httpCode = 402;
        $this->message  = 'Payement Required';
        return $this;
    }

    public function reponse403(): self
    {
        $this->httpCode = 403;
        $this->message  = 'Forbidden';
        return $this;
    }

    public function reponse404(): self
    {
        $this->httpCode = 404;
        $this->message  = 'OK';
        return $this;
    }

    public function reponse405(): self
    {
        $this->httpCode = 405;
        $this->message  = 'Method Not Allowed';
        return $this;
    }

    public function reponse406(): self
    {
        $this->httpCode = 406;
        $this->message  = 'Not Acceptable';
        return $this;
    }

    public function reponse408(): self
    {
        $this->httpCode = 408;
        $this->message  = 'Request Time-out';
        return $this;
    }


    // 500

    public function reponse500(): self
    {
        $this->httpCode = 500;
        $this->message  = 'Internal Server Error';
        return $this;
    }

    public function reponse501(): self
    {
        $this->httpCode = 501;
        $this->message  = 'Not Implemented';
        return $this;
    }

    public function reponse502(): self
    {
        $this->httpCode = 502;
        $this->message  = 'Bad Gateway';
        return $this;
    }

    public function reponse503(): self
    {
        $this->httpCode = 503;
        $this->message  = 'Service Unavailable';
        return $this;
    }

    public function reponse505(): self
    {
        $this->httpCode = 505;
        $this->message  = 'HTTP Version not supported';
        return $this;
    }

    public function reponse511(): self
    {
        $this->httpCode = 511;
        $this->message  = 'Network authentication required';
        return $this;
    }
}
