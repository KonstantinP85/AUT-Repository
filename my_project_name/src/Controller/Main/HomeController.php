<?php


namespace App\Controller\Main;


use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="main page")
     */
    public function index()
    {
        $forRender = parent :: renderDefault();
        return $this->render('main/index.html.twig', $forRender);

    }
}