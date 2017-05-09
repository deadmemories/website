<?php

namespace Bundle\Model\Notification;

use Bundle\Repository\Notification\NotifyInterface;

class NotifyModel
{
    /**
     * @var NotifyInterface
     */
    protected $repository;

    /**
     * NotifyModel constructor.
     * @param NotifyInterface $repository
     */
    public function __construct(NotifyInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $data
     * @param string $column
     * @return mixed
     */
    public function getRow($data, string $column = 'id')
    {
        return $this->repository->getRow($data, $column);
    }

    /**
     * @param int $skip
     * @param int $take
     * @return mixed
     */
    public function getAll(int $skip, int $take)
    {
        return $this->repository->getAll($skip, $take);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return $this->repository->update($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        return $this->repository->save($data);
    }
}