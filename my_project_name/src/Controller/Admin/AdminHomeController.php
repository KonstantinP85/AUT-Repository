<?php


namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AdminBaseController
{

    /**
     * @Route("/admin", name="main_admin_page")
     * @return Response
     */
    public function index()
    {
        $forRender = parent:: renderDefault();
        return $this->render('admin/index.html.twig', $forRender);
    }

}