<?php

namespace Bundle\MakeResponse\Traits;

trait GetterForSingle
{
    /**
     * @param $object
     * @param string $method
     * @param array $data
     * @return mixed
     */
    public function getRelationship($object, string $method, array $data)
    {
        if (stristr($method, '.')) {
            $object = $this->getArray($method, $object);
        } else {
            $object = $object->$method;
        }

        if (empty($data[1])) {
            $data = array_shift($data);

            return $object->$data;
        }

        return (array) app('MakeSingle', [$object])->only($data)->result();
    }

    /**
     * @param string $method
     * @param $object
     * @return mixed
     */
    private function getArray(string $method, $object)
    {
        $method = explode('.', $method);

        foreach ($method as $k) {
            $object = $object->$k;
        }

        return $object;
    }
}