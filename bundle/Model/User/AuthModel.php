<?php

namespace Bundle\Model\User;

use Validator;

class AuthModel
{
    /**
     * @var UserModel
     */
    protected $user;

    /**
     * AuthModel constructor.
     * @param UserModel $user
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function auth(array $data)
    {
        $validator = Validator::make(
            $data, [
                'email' => 'required',
                'password' => 'required',
            ]
        );
    }

    public function register(array $data)
    {
        dd(app()->make('UserInfoModel'));
        $validator = Validator::make(
            $data, [
                'email' => 'required|unique:users|min:6|max:40',
                'password' => 'required|min:4|max:30',
                'login' => 'required|min:4|max:20',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                $this->user->response
                    ->changeStatus()
                    ->add('error_data', $validator->messages())
                    ->response('system.validation'),
                400
            );
        }

        $userSave = [
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirm_code' => $this->generateCode()
        ];
        $user = $this->user->insert($userSave);

        $userInfo = app()->make('UserInfoModel');
        $userInfoSave = [
            'user_id' => $user->id,
            'login' => $data['login'],
            'vk' => $data['vk'],
            'twitter' => $data['twitter'],
            'facebook' => $data['facebook'],
            'skype' => $data['facebook']
        ];
        $userInfo = $userInfo->insert($userInfoSave);

        if ( $data['image'] ) {
            //
        } else {
            $image = app()->make('DImage');
            $image->insertCommon($user->id);
        }
    }

    /**
     * @param int $length
     * @param string $charset
     * @return string
     */
    private function generateCode(
        int $length = 10,
        string $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
    ): string {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }

        return $str;
    }
}