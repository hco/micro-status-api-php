<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController
{
    /**
     * @Route("/hello")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function hello()
    {
        return new JsonResponse("Hello World");
    }
}