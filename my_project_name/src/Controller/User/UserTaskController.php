<?php


namespace App\Controller\User;


use App\Entity\Task;

use App\Repository\TaskRepositoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserTaskController extends UserBaseController
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;

    }

    /**
     * @Route("/profile/task", name="user_task")
     *
     */
    public function index()
    {
        $userId = $this->getUser()->getId();
        $task = $this->getDoctrine()->getRepository(Task::class)->findBy(['executor' => $userId]);
        $forRender = parent::renderDefault();
        $forRender['title'] = 'User Task';
        $forRender['task'] = $task;
        return $this->render('user/task/index.html.twig', $forRender);
    }

    /**
     * @Route("/profile/task/update", name="user_task_update")
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
            $id = $request->get('Edit_id');
            $task = $this->taskRepository->getOneTask($id);
            $task->setDraft();
            $this->taskRepository->setUpdateTask($task);
            return $this->redirectToRoute('user_task');
    }

}