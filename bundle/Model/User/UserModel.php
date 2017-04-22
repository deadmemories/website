<?php

namespace Bundle\Model\User;

use Bundle\Repository\User\UserEntity;
use Bundle\Repository\User\UserRepository;
use Bundle\ResponseApi\Response;

class UserModel
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var Response
     */
    public $response;

    /**
     * UserModel constructor.
     * @param UserRepository $repository
     * @param Response $response
     */
    public function __construct(UserRepository $repository, Response $response)
    {
        $this->repository = $repository;
        $this->response = $response;
    }

    /**
     * @param $data
     * @param string $column
     * @return mixed
     */
    public function getUser($data, string $column = 'id')
    {
        return $this->repository->getUser($data, $column);
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
    public function insert(array $data)
    {
        return $this->repository->insert($data);
    }
}