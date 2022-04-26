<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Translation\HasLocalePreference;

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
        //dd($this->filter);
        $date1 = $this->filter['date1'];
        $date2 = $this->filter['date2'];
        $category = $this->filter['category'];
        $status = $this->filter['status'];

        return Product::select('id', 'name', 'code', 'price', 'description', 'discount', 'stock', 'status', 'category_id')
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
            //dd($category);
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
            'category'
        ];
    }
}
