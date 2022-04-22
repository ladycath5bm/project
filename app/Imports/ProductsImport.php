<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row): Product
    {
        if (Product::find($row['id'])) {
            $product = Product::find($row['id']);
            $product->update([
                'name' => $row['name'],
                'code' => $row['code'],
                'price' => $row['price'],
                'description' => $row['description'],
                'discount' => $row['discount'],
                'stock' => $row['stock'],
                'status' => $row['status'],
                'slug' => $row['name'],
                'category_id' => $this->assignCategory($row['category']),
                'user_id' => auth()->id(),
            ]);

            return $product;
        } else {
            
            return new Product([
                'name' => $row['name'],
                'code' => $row['code'],
                'price' => $row['price'],
                'description' => $row['description'],
                'discount' => $row['discount'],
                'stock' => $row['stock'],
                'status' => $row['status'],
                'slug' => $row['name'],
                'category_id' => $this->assignCategory($row['category']),
                'user_id' => auth()->id(),
            ]);
        }
    }

    private function assignCategory(string $category)
    {
        return Category::select('id')->where('name', $category)->first()->id;
    }
}
