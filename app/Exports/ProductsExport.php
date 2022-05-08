<?php

namespace App\Exports;

use App\Constants\ProductStatus;
use Throwable;
use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;

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
        return $status == 'all' ? ProductStatus::toArray() : [$status];
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

    public function failed(Throwable $exception): void
    {
        // handle failed export
    }
}
