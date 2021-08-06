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

    /**
     * @return array
     */
    public function getAllTask(): array
    {
        return parent::findAll();
    }

    /**
     * @param int $taskId
     * @return object
     */
    public function getOneTask(int $taskId): object
    {
        return parent::find($taskId);
    }

    /**
     * @param Task $task
     * @return object
     */
    public function setCreateTask(Task $task): object
    {
        $task->setCreateAtValue();
        $task->setExecute();
        $this->manager->persist($task);
        $this->manager->flush();

        return $task;
    }

    /**
     * @param Task $task
     * @return object
     */
    public function setUpdateTask(Task $task): object
    {
        $this->manager->flush();

        return $task;
    }

    /**
     * @param Task $task
     */
    public function setDeleteTask(Task $task)
    {
        $this->manager->remove($task);
        $this->manager->flush();
    }

    /**
     * @param string $id
     * @return array
     */
    public function orderTask(string $id): array
    {
        if ($id == 'All') {
            return parent::findAll();
        } else {
            return parent::findBy(
                ['execute' => "$id"],
                ['create_at' => 'ASC']
            );
        }
    }
}
