<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProductModulesController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        return view('admin.products.module', compact('categories'));
    }

    public function export(Request $request)
    {
        $filter = $request->toArray();
        //return Excel::download(new ProductsExport($filter), 'products.xlsx');
        (new ProductsExport($filter))->queue('products.xlsx');
        return back()->withSuccess('Export started!');

    }

    public function import(Request $request)
    {

        DB::transaction(function () use($request) {

            Excel::import(new ProductsImport, $request->file('file'));
          
        });
        
        return redirect()->route('admin.products.index');
    }
}
