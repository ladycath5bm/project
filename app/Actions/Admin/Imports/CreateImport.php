<?php

namespace App\Actions\Admin\Imports;

use App\Http\Requests\Imports\ImportProductsRequest;
use App\Models\Import;

class CreateImport
{
    public function create(ImportProductsRequest $input): Import
    {
        $import = new Import();

        $import->name = $input['file']->getClientOriginalName();
        $import->records = 0;
        $import->user_id = auth()->id();
        $import->created_at = now();
        $import->save();

        return $import;
    }
}
