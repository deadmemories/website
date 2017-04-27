<?php

namespace Bundle\Model\UserInfo;

use Bundle\Repository\UserInfo\UserInfoRepository;
use Bundle\ResponseApi\Response;

class UserInfoModel
{
    /**
     * @var UserModel
     */
    protected $repository;

    /**
     * UserInfoModel constructor.
     * @param UserInfoRepository $repository
     */
    public function __construct(UserInfoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->repository->insert($data);
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