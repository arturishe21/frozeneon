<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReFill extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|integer',
        ];
    }
}
