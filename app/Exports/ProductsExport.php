<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

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
        $category =$this->filter['category'];
        $status =$this->filter['status'];
        
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
            return [Category::where('name', $category)->first()->id];
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
