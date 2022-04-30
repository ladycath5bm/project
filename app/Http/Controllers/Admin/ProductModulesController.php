<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
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
        //dd(json_encode($request));
        DB::transaction(function () use ($request) {
            $filter = $request->toArray();

            DB::table('exports')->insert([
                'path' => 'public/exports/products-' . date('Y-m-d H') . '.xlsx',
                'query' => json_encode($request->all()),
                'user_id' => auth()->id(),
            ]);

            (new ProductsExport($filter))->queue('public/exports/products-' . date('Y-m-d H') . '.xlsx');
        });
        return back();
    }

    public function exportFile(): StreamedResponse
    {
        return Storage::download('public/exports/products-' . date('Y-m-d H') . '.xlsx');
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
