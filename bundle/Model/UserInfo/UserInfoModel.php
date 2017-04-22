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
     * @var Response
     */
    public $response;

    /**
     * UserInfoModel constructor.
     * @param UserInfoRepository $repository
     * @param Response $response
     */
    public function __construct(UserInfoRepository $repository, Response $response)
    {
        $this->repository = $repository;
        $this->response = $response;
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