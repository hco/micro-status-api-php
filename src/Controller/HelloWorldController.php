<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController
{
    /**
     * @Route("/hello", methods={"GET","HEAD"})
     */
    public function hello()
    {
        return new JsonResponse("Hello World");
    }
}
