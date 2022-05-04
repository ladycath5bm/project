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
            'date1' => 'required|date',
            'date2' => 'required|date',
            'category' => 'required|string|max:3',
            'status' => 'required|string|max:50',
        ];
    }
}
