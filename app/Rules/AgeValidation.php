<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class AgeValidation implements ValidationRule
{

    protected $minAge;

    public function __construct($minAge = 18)
    {
        $this->minAge = $minAge;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $birthDate = Carbon::parse($value);
            $currentDate = Carbon::now();

            // Calculate the age
            $age = $birthDate->diffInYears($currentDate);

            // Check if the age is less than the minimum age
            if ($age < $this->minAge) {
                $fail("The :attribute must indicate an age of at least {$this->minAge} years.");
            }
        } catch (\Exception $e) {
            // If parsing fails, return an error
            $fail('The :attribute is not a valid date.');
        }
    }
}
