<?php

namespace Bundle\Model\User;

use Bundle\Model\Image\CloudImage;
use Bundle\Model\Image\DatabaseImage;
use Bundle\Model\Image\InfoForImage;
use Bundle\Model\UserInfo\UserInfoModel;
use Bundle\Token\TokenModel;
use Bundle\Traits\GenerateHelper;
use Validator;

class AuthModel
{
    use GenerateHelper;

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

    /**
     * @param array $data
     * @return array|string
     */
    public function auth(array $data)
    {
        $user = $this->user->getUser($data['email'], 'email');
        $tokenModel = app()->make(TokenModel::class);
        $userToken = $tokenModel->getToken($user->id, 'entity_id');

        if (! $user) {
            return [
                'error_message' => 'Incorrect email',
                'error_response' => 'user.register.incorrect_email',
                'error_code' => 406,
            ];
        }

        if (0 == $user->confirmed) {
            return [
                'error_message' => 'Confirm email',
                'error_response' => 'user.not_confrimed',
                'error_code' => 406,
            ];
        }

        if (0 != strlen($userToken)) {
            return [
                'error_message' => 'You are already logged',
                'error_response' => 'user.auth.already_logged',
                'error_code' => 406,
            ];
        }

        if (! password_verify($data['password'], $user->password)) {
            return [
                'error_message' => 'Incorrect password',
                'error_response' => 'user.auth.incorrect_password',
                'error_code' => 406,
            ];
        }

        $tokenModel->update([
            'token' => $tokenModel->generateCode()
        ]);

        return $tokenModel->getToken($tokenModel->token);
    }

    /**
     * @param array $data
     * @param array $avatar
     * @return bool
     */
    public function register(array $data, array $avatar): bool
    {
        $userSave = [
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirm_code' => $this->generateCode(),
        ];
        $user = $this->user->save($userSave);

        $userInfo = app()->make(UserInfoModel::class);
        $userInfoSave = [
            'user_id' => $user->id,
            'login' => $data['login'],
            'vk' => $data['registerVk'],
            'twitter' => $data['registerTwitter'],
            'facebook' => $data['registerFacebook'],
            'skype' => $data['registerSkype'],
        ];
        $userInfo = $userInfo->save($userInfoSave);

        $token = app()->make(TokenModel::class);
        $token->save(
            [
                'user_id' => $user->id,
            ]
        );

        $image = app()->make(DatabaseImage::class);
        if (count($avatar)) {
            $path = InfoForImage::getInfo(self::SERVICE, 'path');
            $cloud = app()->make(CloudImage::class);

            $imageType = explode('/', $avatar['mimetype'])[1];
            $newName = $image->generateName($userInfo->login, $user->id, '', $path);
            $newNameDir = $userInfo->login.$user->id.'.'.$imageType;

            $image->update(
                $avatar['id'], [
                'name' => $newName.'.'.$imageType,
                'imagetable_id' => $user->id,
                'status' => 1,
            ]
            );

            $cloud->renameImage($avatar['name'], $newNameDir, $path);
        } else {
            $image->insertCommon($user->id, self::SERVICE);
        }

        return true;
    }
}