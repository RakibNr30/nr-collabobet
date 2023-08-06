<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class MinimumAge implements Rule
{
    protected int $minAge;

    public function __construct($minAge)
    {
        $this->minAge = $minAge;
    }

    public function passes($attribute, $value): bool
    {
        $dob = Carbon::parse($value);
        $minAgeDate = now()->subYears($this->minAge);

        return $dob->lte($minAgeDate);
    }

    public function message(): string
    {
        return "The :attribute must be at least {$this->minAge} years old.";
    }
}
