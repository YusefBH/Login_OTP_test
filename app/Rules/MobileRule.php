<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MobileRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mobileRegex = '~^(\+?98|0)9\d{9}$~';
        preg_match($mobileRegex, $value, $maches);
        if (empty($maches)) {
            $fail(__('validation.regex', ['attribute' => __('custom.phone_number')]));
        }
    }
}
