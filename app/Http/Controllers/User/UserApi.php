<?php

namespace App\Http\Controllers\User;

use Bundle\Model\User\UserModel;
use Bundle\ResponseApi\Response;
use App\Http\Request;

class UserApi {
	public function __construct(UserModel $model, Response $response) 
	{
		$this->model = $model;
	}

	public function getUsers()
	 {
		$users = $this->model->getUsers();
	}
}