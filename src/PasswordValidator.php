<?php

namespace Alissongla\PasswordPermutation;

class PasswordValidator
{
    public function __construct(private string $password)
    {
        $this->password = $this->encryptPassword($password);
    }

    public function validatePassword(array $inputs)
    {
        $possiblePasswords = $this->cartesianProduct($inputs);

        foreach ($possiblePasswords as $possiblePassword) {
            $possiblePassword = implode('', $possiblePassword);
            if (password_verify($possiblePassword, $this->password)) {
                return true;
            }
        }

        return false;
    }

    private function encryptPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function cartesianProduct($arrays, $i = 0) {
        if ($i == count($arrays)) {
            return array(array());
        }

        $result = [];
        foreach ($arrays[$i] as $element) {
            foreach ($this->cartesianProduct($arrays, $i + 1) as $combination) {
                $result[] = array_merge(array($element), $combination);
            }
        }

        return $result;
    }

}