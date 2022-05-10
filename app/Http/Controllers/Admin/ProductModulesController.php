<?php

namespace App\Http\Controllers\Admin;

use App\Events\ProductVisited;
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
use App\Models\Export;
use App\Models\Import;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Jobs\AfterImportJob;
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

    public function export(ExportProductsRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $filter = $request->toArray();
    
            $export = Export::create([
                'name' => 'products-' . now(),
                'query' => json_encode($request->all()),
                'user_id' => auth()->id(),
            ]);

            (new ProductsExport($filter))->queue('public/exports/' . $export->name . '.xlsx')
                ->chain([new CompletExportStatusJob($export->id)]);
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

    public function import(ImportProductsRequest $request): RedirectResponse
    {
        try {
            //$import->import('import-users.xlsx');
        
            $dataImport = $request->validated();
            
            $productImport = DB::transaction(function () use ($dataImport) {

                $import = Import::create([
                    'name' => $dataImport['file']->getClientOriginalName(),
                    'registers' => 4,
                    'user_id' => auth()->id(),
                    'created_at' => now(),
                ]);

                $productImport = new ProductsImport();
                //Excel::import($productImport, $dataImport['file']);
                $productImport->import($dataImport['file']);

                $import->status = $productImport->getFinishedStatus();
                $import->registers = $productImport->getRowsCount();
                $import->save();

                /* if($productImport->failures())
                {
                    dd($productImport->failures());
                    foreach ($productImport->failures() as $failure) {
                        dd($failure->row()); // row that went wrong
                        $failure->attribute(); // either heading key (if using heading row concern) or column index
                        $failure->errors(); // Actual error messages from Laravel validator
                        $failure->values(); // The values of the row that has failed.
                    }
                } */
                return $productImport;
            });
            $value = $productImport->failures();
            return redirect()->route('admin.products.module');

            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                
                foreach ($failures as $failure) {
                    $failure->row();
                    $failure->attribute();
                    $failure->errors();
                    $failure->values();
                }
            }
    }

    public function importsList()
    {
        $imports = Import::select(['id', 'name', 'registers', 'status'])
            ->where('user_id', auth()->id())
            ->get();

        return view('admin.products.importindex', compact('imports'));
    }
}
