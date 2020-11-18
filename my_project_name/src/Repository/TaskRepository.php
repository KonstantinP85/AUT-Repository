<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, Task::class);
    }


    public function getAllTask(): array
    {
        return parent::findAll();
    }

    public function getOneTask(int $taskId): object
    {
        return parent::find($taskId);
    }

    public function setCreateTask(Task $task): object
    {
        $task->setCreateAtValue();
        $task->setExecute();
        $this->manager->persist($task);   //фокусируемся
        $this->manager->flush();          //добавляем
        return $task;
    }

    public function setUpdateTask(Task $task): object
    {
        $this->manager->flush();
        return $task;
    }

    public function setDeleteTask(Task $task)
    {
        $this->manager->remove($task);
        $this->manager->flush();
    }
}
