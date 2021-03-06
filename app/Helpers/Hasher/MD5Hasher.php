<?php

namespace App\Helpers\Hasher;

use Illuminate\Contracts\Hashing\Hasher;

class MD5Hasher implements Hasher
{
    /**
     * @param string $hashedValue
     *
     * @return array
     */
    public function info($hashedValue)
    {
        return password_get_info($hashedValue);
    }

    /**
     * @param string $value
     * @param string $hashedValue
     * @param array  $options
     *
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        return $this->make($value) === $hashedValue;
    }

    /**
     * @param string $hashedValue
     * @param array  $options
     *
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }

    /**
     * @param string $value
     * @param array  $options
     *
     * @return string
     */
    public function make($value, array $options = [])
    {
        $value = env('SALT', '') . $value;

        return md5($value);
    }
}
