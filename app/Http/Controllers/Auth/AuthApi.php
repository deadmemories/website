<?php

namespace App\Http\Controllers\Auth;

use Bundle\Model\User\AuthModel;
use Illuminate\Http\Request;
use Validator;

class AuthApi
{
    /**
     * @var AuthModel
     */
    protected $model;

    /**
     * AuthApi constructor.
     * @param AuthModel $model
     */
    public function __construct(AuthModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        return $this->model->register($request->all());
    }

    /**
     * @param Request $request
     */
    public function auth(Request $request)
    {
        return $this->model->auth($request->all());
    }
}