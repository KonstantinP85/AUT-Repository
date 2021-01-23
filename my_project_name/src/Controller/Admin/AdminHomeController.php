<?php


namespace App\Controller\Admin;

use App\Form\FinanceType;
use App\Services\FinanceNewsService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AdminBaseController
{
    private $financeNews;

    public function __construct(FinanceNewsService $financeNews)
    {
        $this->financeNews = $financeNews;
    }

    /**
     * @Route("/admin", name="main_admin_page")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $form = $this -> createForm(FinanceType::class);
        $form->handleRequest($request);
        $forRender = parent::renderDefault();
        if ($form->isSubmitted() && $form->isValid())
        {
            $data=$form->getData();
            $forRender['data']=$this->financeNews->fin_news($data);
        }
        $forRender['form'] = $form->createView();
        return $this->render('admin/index.html.twig', $forRender);
    }

}