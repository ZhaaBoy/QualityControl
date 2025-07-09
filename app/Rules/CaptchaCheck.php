<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CaptchaCheck implements Rule
{
    public function passes($attribute, $value)
    {
        return captcha_check($value);
    }

    public function message()
    {
        return 'Captcha validation failed. Please try again.';
    }
}
