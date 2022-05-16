<?php

namespace App\Actions\Admin\Exports;

use App\Models\Export;

class CreateExport
{
    public function create(array $input): Export
    {
        $export = new Export();

        $export->name = 'products-' . now();
        $export->query = json_encode($input);
        $export->user_id = auth()->id();

        $export->save();

        return $export;
    }
}
