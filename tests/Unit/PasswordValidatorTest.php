<?php

use Alissongla\PasswordPermutation\PasswordValidator;

test('Password input should be correct', function () {
    $expectedResult = false;
    $password = '123456';
    $passwordValidator = new PasswordValidator($password);

    $inputs = [
        [1,9],
        [2,3],
        [2,3],
        [4,7],
        [5,6],
        [5,6],
    ];

    if($passwordValidator->validatePassword($inputs)) {
        $expectedResult = true;
    }

    expect($expectedResult)->toBeTrue();
});
