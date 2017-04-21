<?php

namespace Bundle\MakeResponse;

class MakeArray
{
    protected $data;

    /**
     * @var \stdClass
     */
    protected $result;

    /**
     * MakeArray constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->result = new \stdClass();
    }

    /**
     * @param array $data
     * @return MakeArray
     */
    public function except(array $data): MakeArray
    {
        $result = [];

        foreach ($data as $k) {
            foreach ($this->data as $key => $value) {
                foreach ($value->getAttributes() as $index => $v) {
                    if (stristr($k, '.')) {
                        $result = $this->dataWithMulti($key, $v);
                    } else {
                        if ($k != $index) {
                            $result[$key][$index] = $v;
                        }
                    }
                }
            }
        }

        $this->result = $result;

        return $this;
    }

    /**
     * @param array $data
     * @return MakeArray
     */
    public function only(array $data): MakeArray
    {
        $result = [];

        foreach ($data as $k) {
            foreach ($this->data as $key => $value) {
                foreach ($value->getAttributes() as $index => $v) {
                    if (stristr($k, '.')) {
                        $result = $this->dataWithMulti($key, $v);
                    } else {
                        if ($k == $index) {
                            $result[$key][$index] = $v;
                        }
                    }
                }
            }
        }

        $this->result = $result;

        return $this;
    }

    /**
     * @param string $key
     * @param string $name
     * @return MakeArray
     */
    public function rename(string $key, string $name): MakeArray
    {
        foreach ($this->result as $k => $v) {
            if ($v[$key] == $key) {
                $v[$name] = $v[$k];
                unset($v[$k]); // ???
            }
        }

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
}