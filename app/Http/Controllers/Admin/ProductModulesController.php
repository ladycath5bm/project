<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Exports\CreateExport;
use App\Models\Export;
use App\Models\Import;
use App\Models\Category;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Actions\Admin\Imports\CreateImport;
use App\Jobs\Exports\CompletExportStatusJob;
use App\Http\Requests\Exports\ExportProductsRequest;
use App\Http\Requests\Imports\ImportProductsRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductModulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.products.modules');
    }

    public function index(): View
    {
        $categories = Category::all();
        return view('admin.products.module', compact('categories'));
    }

    public function export(CreateExport $createExport, ExportProductsRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request, $createExport) {
            
            $filter = $request->validated();
            $export = $createExport->create($filter);

            (new ProductsExport($filter))->queue('public/exports/' . $export->name . '.xlsx')
                ->chain([new CompletExportStatusJob($export)]);
        });
        
        return back();
    }

    public function exportsList(): View
    {
        $exports = Export::select('id', 'name', 'status')
            ->where('user_id', auth()->id())
            ->get();

        return view('admin.products.exportindex', compact('exports'));
    }

    public function exportFile(int $id = null): StreamedResponse
    {
        if ($id == null)
        {
            $id = Export::select('id')
                ->where('user_id', auth()->id())
                ->latest('id')
                ->first()
                ->id;
        }
        $export = Export::find($id);

        return Storage::download('public/exports/' . $export->name . '.xlsx', $export->name . '.xlsx');
    }

    public function import(CreateImport $createImport, ImportProductsRequest $request): RedirectResponse
    {
        $dataImport = $request;

        DB::transaction(function () use ($dataImport, $createImport) {
            
            $import = $createImport->create($dataImport);
            (new ProductsImport($import))->import($dataImport['file']);
        });

        return redirect()->route('admin.products.module');
    }

    public function importsList()
    {
        $imports = Import::select(['id', 'name', 'records', 'status'])
            ->where('user_id', auth()->id())
            ->get();

        return view('admin.products.importindex', compact('imports'));
    }
}
