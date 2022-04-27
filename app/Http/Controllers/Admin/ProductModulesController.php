<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        //DB::table('exports')
        $filter = $request->toArray();

        (new ProductsExport($filter))->queue('public/exports/products-' . date('Y-m-d H') . '.xlsx');
        return back();
    }

    public function exportFile()
    {
        return Storage::download('public/exports/products-' . date('Y-m-d H') . '.xlsx');
    }

    public function import(Request $request)
    {
        DB::transaction(function () use ($request) {
            Excel::import(new ProductsImport(), $request->file('file'));
        });

        return redirect()->route('admin.products.index');
    }


    /* public function import(ImportedExcelRequest $request)
    {

        DB::transaction(function () use($request) {

            $file = $request->file('file');
            $modelImport=Import::create();
            $import = new TodoImport($modelImport);
            Excel::import($import, $file);
            $modelImport->filename=$file->getClientOriginalName();
            $modelImport->row_quantity=$import->getRowCount();
            $modelImport->save();
//            dd('si funcione XD');
        },3);


//        return view('app');
        return redirect('/app');
    } */
}
