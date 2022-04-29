<?php

namespace App\Imports;

use App\Models\Product;
use App\Rules\ProductImportRules;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductsImport implements ToModel, WithHeadingRow, WithUpserts, WithChunkReading, WithValidation
{
    use Importable;

    private int $rows = 0;

    public function model(array $row): Product
    {
        ++$this->rows;
        $product = Product::find($row['id']);
        $product->update($this->getData($row));
        return $product;
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
    
    public function uniqueBy()
    {
        return 'code';
    }

    public function chunkSize(): int
    {
        return 20;
    }

    public function rules(): array
    {
        return ProductImportRules::toArray();
    }
}
