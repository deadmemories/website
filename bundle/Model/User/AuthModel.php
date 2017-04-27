<?php

namespace Bundle\Model\User;

use Validator;

class AuthModel
{
    protected const SERVICE = 'user';

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
    }

    public function register(array $data)
    {
        $userSave = [
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirm_code' => $this->generateCode(),
        ];
        $user = $this->user->insert($userSave);

        $userInfo = app()->make('UserInfoModel');
        $userInfoSave = [
            'user_id' => $user->id,
            'login' => $data['login'],
            'vk' => $data['vk'],
            'twitter' => $data['twitter'],
            'facebook' => $data['facebook'],
            'skype' => $data['facebook'],
        ];
        $userInfo = $userInfo->insert($userInfoSave);

        $image = app()->make('DImage');
        if ($data['image']) {
            $data['image']['imagetable_id'] = $user->id;
            $image->insert($data['image'], self::SERVICE);
        } else {
            $image->insertCommon($user->id, self::SERVICE);
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