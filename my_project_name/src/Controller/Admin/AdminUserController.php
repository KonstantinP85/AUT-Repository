<?php


namespace App\Controller\Admin;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AdminBaseController
{
    /**
     * @Route("/admin/user", name="admin_user")
     * @return Response
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Admin Users';
        $forRender['users'] = $users;
        return $this->render('admin/user/index.html.twig', $forRender);
    }
    /**
     * @Route("/admin/user/create", name="admin_user_create")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user); //вписал шаблон формы
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);                       //получаем данные из формы

        if(($form->isSubmitted()) && ($form->isValid()))      //проверяем данные из формы
        {
            $password = $passwordEncoder->encodePassword($user,$user->getPlainPassword()); //шифруем пароль
            $user->setPassword($password);      //  помещаем пароль в сущность юзер
            $user->setRoles(["ROLE_ADMIN"]);
            $em->persist($user);                //фокусируемся
            $em->flush();                      //сохраняем данные
            $this->addFlash('success', 'User was added!');
            return $this->redirectToRoute('admin_user');
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Admin registration form';
        $forRender['form'] = $form->createView(); //для создания вида формы
        return $this->render('admin/user/form.html.twig', $forRender);

    }
}