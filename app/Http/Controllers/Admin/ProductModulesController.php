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
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Jobs\Exports\CompletExportStatusJob;
use App\Http\Requests\Exports\ExportProductsRequest;
use App\Http\Requests\Imports\ImportProductsRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductModulesController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        return view('admin.products.module', compact('categories'));
    }

    public function export(Request $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            
            $filter = $request->toArray();

            $id = DB::table('exports')->insertGetId([
                'path' => 'public/exports/products-' . date('Y-m-d H') . '.xlsx',
                'query' => json_encode($request->all()),
                'user_id' => auth()->id(),
            ]);

            (new ProductsExport($filter))->queue('public/exports/products-' . date('Y-m-d H') . '.xlsx')
                ->chain([new CompletExportStatusJob($id)]);

        });
        
        return back();
    }

    public function exportFile(): StreamedResponse
    {
        return Storage::download('public/exports/products.xlsx', 'hola.xlsx');
    }

    public function import(Request $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $import = new ProductsImport();
            Excel::import($import, $request->file('file'));
            
            DB::table('imports')->insert([
                'name' => $request->file('file')->getClientOriginalName(),
                'registers' => $import->getRowsCount(),
                'user_id' => auth()->id(),
                'created_at' => now(),
            ]);
        });

        return redirect()->route('admin.products.module');
    }
}
