<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UsMobileNumber implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^\d{10}$/', $value);
    }

    public function message(): string
    {
        return 'The :attribute must be a valid USA mobile number.';
    }
}
