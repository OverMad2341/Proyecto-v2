<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class HCaptcha implements ValidationRule
{
    /**
      *Run the validation rule.*
      *@param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail*/
    public function validate(string $attribute, mixed $value, Closure $fail): void{
        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            'secret' => env('HCAPTCHA_SECRET_KEY'),
            'response' => $value,
            'remoteip' => request()->ip(),]);

        if (!$response->json('success')) {
            $fail('La verificación de hCaptcha ha fallado. Por favor, inténtalo de nuevo.');
        }
    }
}
