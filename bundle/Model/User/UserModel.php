<?php

namespace Bundle\Model\User;

use Bundle\Repository\User\UserEntity;
use Bundle\ResponseApi\Response;

class UserModel
{
    /**
     * @var UserModel
     */
    protected $entity;

    /**
     * @var Response
     */
    protected $response;

    /**
     * UserRepository constructor.
     * @param UserModel $entity
     * @param Response $response
     */
    public function __construct(UserModel $entity, Response $response)
    {
        $this->entity = $entity;
        $this->response = $response;
    }
}