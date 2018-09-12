<?php

namespace App\Controller;


use App\Http\ResponseInterface;

interface ControllerInterface
{

    /**
     * Bind data in templates then build response
     * @param string $path template path
     * @param array $data properties binding
     * @return Response builded response
     */
    public function render(
        string $path,
        array $data): ResponseInterface;

}
