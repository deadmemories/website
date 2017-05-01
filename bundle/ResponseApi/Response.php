<?php

namespace Bundle\ResponseApi;

class Response
{
    /**
     * @var array
     */
    protected $errors = [
        'system' => [
            'validation' => 426,
            'system' => 500
        ],
        'user' => [
            'register' => [
                'incorrect_email' => 323
            ]
        ]
    ];

    /**
     * @var array
     */
    protected $data = [
        'error' => false,
    ];

    /**
     * @return Response
     */
    public function changeStatus(): Response
    {
        $this->data['error'] = true;

        return $this;
    }

    /**
     * @param string $key
     * @param $data
     * @return Response
     */
    public function add(string $key, $data): Response
    {
        $this->data[$key] = $data;

        return $this;
    }

    /**
     * @param string $errorCode
     * @return array
     */
    public function response(string $errorCode = ''): array
    {
        if (0 != strlen($errorCode)) {
            if (stristr($errorCode, '.')) {
                $this->addErrorInfoMulti($errorCode);
            } else {
                $this->addErrorInfoSingle($errorCode);
            }
        }

        return $this->data;
    }

    /**
     * @param string $errorCode
     */
    private function addErrorInfoSingle(string $errorCode): void
    {
        $this->data['status'] = $this->errors[$errorCode];
    }

    /**
     * @param string $errorCode
     * @return mixed
     */
    private function addErrorInfoMulti(string $errorCode)
    {
        $errorCode = explode('.', $errorCode);
        $key = array_shift($errorCode);
        $value = $this->errors[$key];

        if (! count($errorCode)) {
            return $value;
        }

        foreach ($errorCode as $k) {
            $value = $value[$k];
        }

        $this->data['status'] = $value;
    }
}