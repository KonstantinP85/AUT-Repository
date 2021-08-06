<?php


namespace App\Controller\Admin;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepositoryInterface;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminUserController extends AdminBaseController
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserService $userService
     */
    public function __construct(UserRepositoryInterface $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * @Route("/admin/user", name="admin_user")
     * @return Response
     */
    public function index(): Response
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Admin Users';
        $forRender['users'] = $this->userRepository->getAll();

        return $this->render('admin/user/index.html.twig', $forRender);
    }

    /**
     * @Route("/admin/user/create", name="admin_user_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if (($form->isSubmitted()) && ($form->isValid())) {
            $this->userService->handleCreate($user);
            $this->addFlash('success', 'User was added!');
            return $this->redirectToRoute('admin_user');
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Admin registration form';
        $forRender['form'] = $form->createView();

        return $this->render('admin/user/form.html.twig', $forRender);
    }

    /**
     * @Route("/admin/user/update/{userId}", name="admin_user_update")
     * @param Request $request
     * @param int $userId
     * @return Response
     */
    public function update(Request $request, int $userId): Response
    {
        $user = $this->userRepository->getOne($userId);
        $formUser = $this->createForm(UserType::class);
        $formUser->handleRequest($request);

        if ($formUser->isSubmitted() && $formUser->isValid()) {
            if ($formUser->get('save')->isClicked()) {
                $this->userRepository->setUpdateUser($user);
                $this->addFlash('success', 'Task was updated!');
            }
            if ($formUser->get('delete')->isClicked()) {
                $this->userRepository->setDeleteUser($user);
                $this->addFlash('success', 'Task was deleted!');
            }
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Admin Update User';
        $forRender['form'] = $formUser->createView();

        return $this->render('admin/user/form.html.twig', $forRender);
    }
}
