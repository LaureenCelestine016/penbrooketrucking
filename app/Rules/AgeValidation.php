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

    public function passes()
    {

    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
