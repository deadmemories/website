<?php

namespace Bundle\Token\Repository;

use Bundle\Token\Eloquent\Token;
use Illuminate\Database\Eloquent\Collection;

class TokenRepository implements TokenRepositoryInterface
{
    /**
     * @var Token
     */
    protected $eloquent;

    /**
     * TokenRepository constructor.
     * @param Token $eloquent
     */
    public function __construct(Token $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param string $column
     * @param $data
     * @return mixed
     */
    public function get(string $column, $data): Collection
    {
        return $this->eloquent->where($column, $data)->first();
    }

    /**
     * @param string $column
     * @param $data
     * @return bool
     */
    public function remove(string $column, $data): bool
    {
        return $this->eloquent->where($column, $data)->delete();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        return $this->eloquent->save($data);
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function update(array $data): Collection
    {
        return $this->eloquent->update($data);
    }
}