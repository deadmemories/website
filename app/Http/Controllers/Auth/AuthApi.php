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
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $userData = $request->user;

        $validator = Validator::make(
            $userData, [
                'email' => 'required|unique:users,email|min:6|max:40',
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

        if ($this->model->register($userData, $request->image)) {
            return response()->json(
                $this->response->add('response', 'Thank you for register')->response(), 200
            );
        } else {
            return response()->json(
                $this->response
                    ->changeStatus()
                    ->add('error_data', 'Server error. Try later.')
                    ->response('system.server'),
                500
            );
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function auth(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'email' => 'required|min:6|max:40',
                'password' => 'required|min:4|max:30',
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

        $result = $this->model->auth($request->all());

        if (is_array($result)) {
            return response()->json(
                $this->response
                    ->changeStatus()
                    ->add('error_data', $result['error_message'])
                    ->response($result['error_response']),
                $result['error_code']
            );
        } else {
            return response()->json(
                $this->response->add('response', $result)->response(), 200
            );
        }
    }
}