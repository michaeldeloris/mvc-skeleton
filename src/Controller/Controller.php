<?php

namespace App\Controller;

use App\Http\ResponseInterface;
use App\DataBase\PDOHandler;
use App\Model\Token;

class Controller implements ControllerInterface
{
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->setSecureToken();
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

    protected function getToken(): Token
    {
        return $_SESSION["token"];
    }

    private function setSecureToken()
    {
        session_start();
        if (!array_key_exists("token", $_SESSION)) {

            $token = new Token();
            $token->setIp(filter_input(INPUT_SERVER, "REMOTE_ADDR"));
            $token->setUserAgent(filter_input(INPUT_SERVER, "HTTP_USER_AGENT"));
            $token->setKey(md5(openssl_random_pseudo_bytes(32)));
            $_SESSION["token"] = $token;
        }
    }

    protected function isCsrfTokenValid(): bool
    {
        $token = $this->getToken();
        $inputToken = $this->get("token");
        if (!$inputToken) {
            $inputToken = $this->get("token");
        }
        if (!(string)$token === $inputToken
            || !((string)$this->getToken()->getIp() === filter_input(INPUT_SERVER, "REMOTE_ADDR"))
            || !((string)$this->getToken()->getUserAgent() === filter_input(INPUT_SERVER, "HTTP_USER_AGENT"))
        ) {
            echo("NON");
            return false;
        }
        echo("OUI");
        return true;
    }

    protected function get(string $variableName, $regExp = null)
    {
        $options = null;
        $filterValidate = FILTER_DEFAULT;
        $inputType = array_key_exists($variableName, $_GET) ? INPUT_GET : INPUT_POST;
        if($regExp){
            $filterValidate = FILTER_VALIDATE_REGEXP;
            $options = ["options" => ["regexp" => $regExp]];
        }
        return filter_input($inputType, $variableName, $filterValidate, $options);
    }

    protected function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}