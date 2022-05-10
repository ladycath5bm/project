<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Constants\ExcelStatus;
use App\Rules\ProductImportRules;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;

class ProductsImport implements ToModel, 
    WithHeadingRow, 
    WithUpserts, 
    WithUpsertColumns,
    WithBatchInserts, 
    WithChunkReading, 
    WithValidation, 
    ShouldQueue, 
    SkipsEmptyRows, 
    SkipsOnFailure

{
    use Importable, SkipsFailures;

    private int $rows = 0;

    public function model(array $row): Product
    {
        $this->rows++;

        return new Product($this->getData($row));
    }

    private function getData(array $row): array
    {
        return [
            'name' => $row['name'],
            'code' => $row['code'],
            'price' => $row['price'],
            'description' => $row['description'],
            'discount' => $row['discount'],
            'stock' => $row['stock'],
            'status' => $this->assignStatus($row['status']),
            'slug' => $row['name'],
            'category_id' => $this->assignCategory($row['category']),
            'user_id' => auth()->id(),
        ];
    }

    private function assignCategory(string $category): int
    {
        return Category::select('id')->where('name', $category)->first()->id;
    }

    private function assignStatus(?string $status): string
    {
        return $status == null ? '0' : $status;
    }

    public function getRowsCount(): int
    {
        return $this->rows;
    }

    public function getFinishedStatus(): string
    {
        return ExcelStatus::FINISHED;
    }

    public function uniqueBy(): string
    {
        return 'code';
    }

    public function upsertColumns()
    {
        return ['name', 'price', 'description', 'discount', 'stock', 'status', 'category_id'];
    }

    public function batchSize(): int
    {
        return 10;
    }

    public function chunkSize(): int
    {
        return 10;
    }

    public function rules(): array
    {
        return ProductImportRules::toArray();
    }

    public function customValidationMessages(): array
    {
        return [
            'name.required' => 'Campo :attribute es requerido',
            'name.string' => 'Campo :attribute debe ser de tipo texto',
            'name.min' => 'El campo :attribute debe tener mas de dos caracteres',
            'name.max' => 'el campo :attribute debe tener mas de dos caracteres',
        ];
    }
}
