<?php


namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserHomeController extends UserBaseController
{
    /**
     * @Route("/profile", name="main_user_page")
     * @return Response
     */
    public function index()
    {

        $forRender = parent:: renderDefault();
        return $this->render('user/index.html.twig', $forRender);
    }
}