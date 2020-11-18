<?php


namespace App\Controller\Admin;


use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTaskController extends AdminBaseController
{
    /**
     * @Route("/admin/task", name="admin_task")
     *
     */
    public function index()
    {
        $task = $this->getDoctrine()->getRepository(Task::class)->findAll();


        $forRender = parent::renderDefault();
        $forRender['title'] = 'Admin Tasks';
        $forRender['task'] = $task;
        return $this->render('admin/task/index.html.twig', $forRender);
    }

    /**
     * @Route("/admin/task/create", name="admin_task_create")
     * @param Request $request     *
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();                // entity manager
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);  //для того чтобы форма принимала значение сущности добавляем $task
        $form -> handleRequest($request);                        //принимаем данные формы
        if ($form->isSubmitted() && $form->isValid())            //проверяем данные из формы
        {
            $task->setCreateAtValue();
            $task->setExecute();
            $em->persist($task);                                 //фокусируемся
            $em->flush();                                        //добавляем
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
        $em = $this->getDoctrine()->getManager();
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if ($form->get('save')->isClicked())
            {

                $this->addFlash('success', 'Task was updated!');

            }
            if ($form->get('delete')->isClicked())
            {
                $em->remove($task);
                $this->addFlash('success', 'Task was deleted!');
            }
            $em->flush();
            return $this->redirectToRoute('admin_task');
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Update task';
        $forRender['form'] = $form->createView();
        return $this->render('admin/task/form.html.twig', $forRender);
    }

}