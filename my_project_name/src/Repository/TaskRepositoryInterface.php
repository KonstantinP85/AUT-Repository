<?php


namespace App\Repository;


use App\Entity\Task;

interface TaskRepositoryInterface
{
    /**
     * @return Task[]
     */
    public function getAllTask(): array;

    /**
     * @param int $taskId
     * @return Task
     */
    public function getOneTask(int $taskId): object;

    /**
     * @param Task $task
     * @return object
     */
    public function setCreateTask(Task $task): object;

    /**
     * @param Task $task
     * @return object
     */
    public function setUpdateTask(Task $task): object;

    /**
     * @param Task $task
     */
    public function setDeleteTask(Task $task);
}