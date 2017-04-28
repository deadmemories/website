<?php

namespace Bundle\Traits;

trait GenerateHelper
{
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