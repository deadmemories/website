<?php

namespace Bundle\MakeResponse;

class MakeSingle
{
    /**
     * @var Eloquent
     */
    protected $data;

    /**
     * @var \stdClass
     */
    protected $result;

    public function __construct($data)
    {
        $this->data = $data;
        $this->result = new \stdClass();
    }

    /**
     * @param array $data
     * @return MakeSingle
     */
    public function except(array $data): MakeSingle
    {
        $result = [];

        foreach ($this->data->getAttributes() as $key => $value) {
            foreach ($data as $k) {
                if (stristr($key, '.')) {
                    $result = $this->dataWithMulti($k, $value);
                } elseif ($k != $key) {
                    $result[$key] = $value;
                }
            }
        }

        $this->result = $result;

        return $this;
    }

    /**
     * @param array $data
     * @return MakeSingle
     */
    public function only(array $data): MakeSingle
    {
        $result = [];

        foreach ($this->data->getAttributes() as $key => $value) {
            foreach ($data as $k) {
                if (stristr($key, '.')) {
                    $result = $this->dataWithMulti($k, $value);
                } elseif ($k == $key) {
                    $result[$key] = $value;
                }
            }
        }

        $this->result = (object) $result;

        return $this;
    }

    /**
     * @param string $key
     * @param string $name
     * @return MakeSingle
     */
    public function rename(string $key, string $name): MakeSingle
    {
        $this->data->$name = $this->data->$key;
        unset($this->data->$key);

        $this->result->$name = $this->result->$key;
        unset($this->result->$key);

        return $this;
    }

    /**
     * @return object|\stdClass
     */
    public function getResult()
    {
        return 0 != count((array) ($this->result))
            ? $this->result
            : (object) $this->data->getAttributes();
    }

    /**
     * @param string $name
     * @return mixed
     */
    private function dataWithMulti(string $name)
    {
        $data = $this->data ? $this->data->getAttributes() : $this->response;

        $name = explode('.', $name);
        $key = array_shift($name);

        if (! $name[1]) {
            return $this->data->$key ?? $this->response->$key;
        }

        foreach ($name as $k) {
            $data = $data[$k];
        }

        return $data;
    }
}