<?php

namespace App\Controller;

use App\Http\ResponseInterface;
use App\DataBase\PDOHandler;

class Controller implements ControllerInterface
{
    private $response;
    public $toto = 12;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    protected function getPDO(): \PDO
    {
        return PDOHandler::getPDO();
    }

    public function render(string $path, array $data = []): ResponseInterface
    {
        $filename = __DIR__ . "/../../template/" . $path;
        if (!is_file($filename)) {
            throw new \RunTimeException("Template not found: " . $filename);
        }
        extract($data);
        ob_start();
        include $filename;
        $body = ob_get_contents();
        ob_end_clean();

        $this->response->setBody($body);
        return $this->response;
    }
}