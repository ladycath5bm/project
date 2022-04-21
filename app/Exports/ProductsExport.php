<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProductsExport implements FromQuery
{
    use Exportable;

    protected array $filter;

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

    private function categoryQuery(string $category)
    {
        if ($category == 'all') {
            $array = Category::all('id');
            return $array;
        } else {
            return [Category::select('id')->where('name', $category)->first()];
        }
    }

    private function statusQuery(string $status)
    {
        if ($status == 'all') {
            return [0, 1];
        } else {
            return [$status];
        }
    }
}
