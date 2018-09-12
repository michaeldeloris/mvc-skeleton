<?php

namespace App\Http;

class Response implements ResponseInterface
{

    private $body = "";
    private $header = [];
    private $statusCode = 200;
    private $statusText = "OK";

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function getHeader(): array
    {
        return $this->header;
    }

    public function setHeader(array $header)
    {
        $this->header = $header;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getStatusText(): string
    {
        return $this->statusText;
    }

    public function setStatus(int $statusCode, string $statusText)
    {
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }
}