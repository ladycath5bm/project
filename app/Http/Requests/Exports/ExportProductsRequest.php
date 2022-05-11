<?php

namespace App\Http\Requests\Exports;

use Illuminate\Foundation\Http\FormRequest;

class ExportProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => 'required|date_format:Y-m-d|before:tomorrow',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
            'category' => 'required|string|min:1|max:3',
            'status' =>  'required|string|min:3|max:8',
        ];
    }
}
