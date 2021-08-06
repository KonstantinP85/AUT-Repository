<?php

namespace App\Controller\Main;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="main page")
     * @return Response
     */
    public function index(): Response
    {
        $forRender = parent :: renderDefault();

        return $this->render('main/index.html.twig', $forRender);
    }
}