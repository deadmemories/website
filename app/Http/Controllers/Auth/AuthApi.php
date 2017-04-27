<?php

namespace App\Http\Controllers\Auth;

use Bundle\Model\User\AuthModel;
use Bundle\ResponseApi\Response;
use Illuminate\Http\Request;
use Validator;

class AuthApi
{
    /**
     * @var AuthModel
     */
    protected $model;

    /**
     * @var Response
     */
    protected $response;

    /**
     * AuthApi constructor.
     * @param AuthModel $model
     * @param Response $response
     */
    public function __construct(AuthModel $model, Response $response)
    {
        $this->model = $model;
        $this->response = $response;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request, [
                'email' => 'required|unique:users|min:6|max:40',
                'password' => 'required|min:4|max:30',
                'login' => 'required|min:4|max:20',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                $this->response
                    ->changeStatus()
                    ->add('error_data', $validator->messages())
                    ->response('system.validation'),
                400
            );
        }

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