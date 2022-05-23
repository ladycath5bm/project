<?php

namespace App\Exports;

use Throwable;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Carbon;
use App\Constants\ProductStatus;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
                Carbon::parse($this->filter['start_date'])->startOfDay(), 
                Carbon::parse($this->filter['end_date'])->endOfDay()])
            ->whereIn('category_id', $this->categoryQuery($this->filter['category']))
            ->whereIn('status', $this->statusQuery($this->filter['status']));
    }

    private function categoryQuery(string $category): array
    {
        if ($category == 'all') {
            return Category::all('id')->toArray();
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
