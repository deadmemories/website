<?php

namespace Bundle\MakeResponse;

use Bundle\MakeResponse\Traits\GetterForSingle;

class MakeSingle
{
    use GetterForSingle;

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
        $this->data = $data[0];
        $this->result = new \stdClass();
    }

    /**
     * @return MakeSingle
     */
    public function all(): MakeSingle
    {
        $this->result = $this->data->getAttributes();

        return $this;
    }

    /**
     * @param array $data
     * @param string $key
     * @return MakeSingle
     * @throws \Exception
     */
    public function replace(array $data, string $key = ''): MakeSingle
    {
        if (0 == strlen($key)) {
            $key = array_keys($data)[0];

            $element = array_shift($data);

            if (count($data)) {
                throw new \Exception('If key is empty data cannot have more one element');
            }

            $this->replaceData($key, $element);
        } else {
            $this->replaceData($key, $data);
        }

        return $this;
    }

    /**
     * @param string $key
     * @param array $data
     */
    private function replaceData(string $key, array $data): void
    {
        if (! is_array(array_values($data)[0])) {
            $this->replaceDataWithoutObjectSingle($key, $data);
        } else {
            $this->replaceDataWithObject($key, $data);
        }
    }

    /**
     * @param string $key
     * @param array $data
     */
    private function replaceDataWithObject(string $key, array $data): void
    {
        foreach ($data as $k => $v) {
            $this->result[$key][$k] = $this->getRelationship($this->data, $v[0], $v[1]);
        }
    }

    /**
     * @param string $key
     * @param array $data
     */
    private function replaceDataWithoutObjectSingle(string $key, array $data): void
    {
        $this->result[$key] = $this->getRelationship($this->data, $data[0], $data[1]);
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
    public function result()
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