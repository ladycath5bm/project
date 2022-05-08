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
            'date1' => 'required|date_format:Y-m-d|before:tomorrow',
            'date2' => 'required|date_format:Y-m-d|after:date1',
            'category' => 'required|string|max:3',
            'status' => 'required|string|max:50',
        ];
    }
}
