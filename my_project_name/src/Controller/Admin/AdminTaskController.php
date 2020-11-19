<?php


namespace App\Controller\Admin;


use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepositoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTaskController extends AdminBaseController
{   
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;

    }

    /**
     * @Route("/admin/task", name="admin_task")
     *
     */
    public function index()
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Admin Tasks';
        $forRender['task'] = $this->taskRepository->getAllTask();
        return $this->render('admin/task/index.html.twig', $forRender);

    }

    /**
     * @Route("/admin/task/create", name="admin_task_create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);  //для того чтобы форма принимала значение сущности добавляем $task
        $form -> handleRequest($request);                        //принимаем данные формы
        if ($form->isSubmitted() && $form->isValid())            //проверяем данные из формы
        {
            $this->taskRepository->setCreateTask($task);
            $this->addFlash('success', 'Task was added!');
            return $this->redirectToRoute('admin_task');
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Create task';
        $forRender['form'] = $form->createView();
        return $this->render('admin/task/form.html.twig', $forRender);
    }

    /**
     * @Route("/admin/task/update/{id}", name="admin_task_update")
     * @param int $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function update(int $id, Request $request)
    {

        $task = $this->taskRepository->getOneTask($id);
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if ($form->get('save')->isClicked())
            {
                $this->taskRepository->setUpdateTask($task);
                $this->addFlash('success', 'Task was updated!');
            }
            if ($form->get('delete')->isClicked())
            {
                $this->taskRepository->setDeleteTask($task);
                $this->addFlash('success', 'Task was deleted!');
            }
            return $this->redirectToRoute('admin_task');
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Update task';
        $forRender['form'] = $form->createView();
        return $this->render('admin/task/form.html.twig', $forRender);
    }

}