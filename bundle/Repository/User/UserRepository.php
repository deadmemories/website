<?php

namespace Bundle\Repository\User;

use Bundle\Entity\User\UserEntity;

class UserRepository
{
    /**
     * @var UserEntity
     */
    protected $entity;

    public function __construct(UserEntity $entity)
    {
        $this->entity = $entity;
    }

    public function users()
    {
        return $this->entity->getUsers();
    }

    public function user()
    {
        return $this->entity->getUser(1);
    }
}