<?php

namespace Bundle\Model\UserInfo;

use Bundle\Repository\UserInfo\UserInfoInterface;

class UserInfoModel
{
    /**
     * @var UserModel
     */
    protected $repository;

    /**
     * UserInfoModel constructor.
     * @param UserInfoInterface $repository
     */
    public function __construct(UserInfoInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        return $this->repository->save($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return $this->repository->update($data);
    }
}