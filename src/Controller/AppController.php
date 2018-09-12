<?php

namespace App\Controller;

use App\Http\Response;

class AppController extends Controller
{

    public function show()
    {
        return $this->render("app/index.html.php", [
            "message" => "Hello World"
        ]);
    }
}