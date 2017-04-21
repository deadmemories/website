<?php

namespace Bundle\Entity\User;

use App\Eloquent\User;

class UserEntity implements UserEntityInterface
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserEntity constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param int $skip
     * @param int $take
     * @return mixed
     */
    public function getUsers(int $skip = 0, int $take = 20)
    {
        return $this->user->skip($skip)->take($take)->get();
    }

    /**
     * @param string $column
     * @param null|string $data
     * @return mixed
     */
    public function getUser(?string $data, string $column = 'id')
    {
        return $this->user->where($column, $data)->first();
    }


    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return $this->user->update($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->user->insert($data);
    }

    /**
     * @param string $column
     * @param null|string $data
     * @return mixed
     */
    public function delete(?string $data, string $column = 'id')
    {
        return $this->user->where($column, $data)->delete();
    }
}