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

class ProductsExport implements FromQuery, WithHeadings, Responsable, ShouldQueue
{
    use Exportable;

    protected array $filter;
    private string $fileName = 'products.xlsx';
    private string $writerType = Excel::XLSX;
    private array $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function __construct(array $filter)
    {
        $this->filter = $filter;
    }

    public function query()
    {
        $date1 = $this->filter['date1'];
        $date2 = $this->filter['date2'];
        $category = $this->filter['category'];
        $status = $this->filter['status'];

        return Product::select('id', 'name', 'code', 'price', 'description', 'discount', 'stock', 'status')
            ->addSelect(['category' => Category::select('name')->whereColumn('id', 'products.category_id')])
            ->whereBetween('created_at', [$date1, $date2])
            ->whereIn('category_id', $this->categoryQuery($category))
            ->whereIn('status', $this->statusQuery($status));
    }

    private function categoryQuery(string $category): array
    {
        if ($category == 'all') {
            $array = Category::all('id')->toArray();
            return $array;
        } else {
            return Category::select('id')->where('name', $category)->first()->toArray();
        }
    }

    private function statusQuery(string $status): array
    {
        if ($status == 'all') {
            return [0, 1];
        } else {
            return [$status];
        }
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
