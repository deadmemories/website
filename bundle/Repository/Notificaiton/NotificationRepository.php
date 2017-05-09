<?php

namespace Bundle\Repository\Notification;

use App\Eloquent\Notification;

class NotificationRepository implements NotifyInterface
{
    /**
     * @var Notification
     */
    protected $eloquent;

    /**
     * NotificationRepository constructor.
     * @param Notification $eloquent
     */
    public function __construct(Notification $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param int $skip
     * @param int $take
     * @return mixed
     */
    public function getAll(int $skip, int $take)
    {
        return $this->eloquent->skip($skip)->take($take)->get();
    }

    /**
     * @param $data
     * @param string $column
     * @return mixed
     */
    public function getRow($data, string $column)
    {
        return $this->eloquent->where($column, $data)->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return $this->eloquent->update($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        return $this->eloquent->create($data);
    }

    /**
     * @param $data
     * @param string $column
     * @return mixed
     */
    public function delete($data, string $column)
    {
        return $this->eloquent->where($column, $data)->delete();
    }
}