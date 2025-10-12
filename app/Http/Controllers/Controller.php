<?php

namespace App\Http\Controllers;

use App\Rules\HCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // ... other validation rules
            'h-captcha-response' => ['required', new HCaptcha()],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // If validation passes, process the data
        // ...

        return response()->json(['message' => 'Successfully received']);
    }
}
