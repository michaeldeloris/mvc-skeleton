<?php

namespace App\Http;


interface ResponseInterface
{
    public function getBody(): string;

    public function setBody(string $body);

    public function getHeader(): array;

    public function setHeader(array $header);

    public function getStatusCode(): int;

    public function getStatusText(): string;

    public function setStatus(int $statusCode, string $statusText);
}