<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class ProductsExport implements FromQuery, WithHeadings, ShouldQueue
{
    use Exportable;

    public function __construct(array $filter)
    {
        $this->filter = $filter;
    }

    public function query()
    {
        return Product::select('id', 'name', 'code', 'price', 'description', 'discount', 'stock', 'status')
            ->addSelect(['category' => Category::select('name')
                ->whereColumn('id', 'products.category_id')])
            ->whereBetween('created_at', [
                $this->filter['date1'], 
                $this->filter['date2']])
            ->whereIn('category_id', $this->categoryQuery($this->filter['category']))
            ->whereIn('status', $this->statusQuery($this->filter['status']));
    }

    private function categoryQuery(string $category): array
    {
        if ($category == 'all') {
            $array = Category::all('id')
                ->toArray();
            return $array;
        } else {
            return Category::select('id')
                ->where('name', $category)
                ->first()
                ->toArray();
        }
    }

    private function statusQuery(string $status): array
    {
        return $status == 'all' ? [0,1] : [$status];
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'code',
            'price',
            'description',
            'discount',
            'stock',
            'status',
            'category',
        ];
    }
}
