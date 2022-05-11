<?php

namespace App\Imports;

use App\Constants\ExcelStatus;
use App\Constants\ProductStatus;
use App\Models\Category;
use App\Models\Import;
use App\Models\Product;
use App\Rules\ProductImportRules;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Validators\Failure;

class ProductsImport implements
    ToModel,
    WithHeadingRow,
    WithUpserts,
    WithUpsertColumns,
    WithBatchInserts,
    WithChunkReading,
    WithValidation,
    ShouldQueue,
    SkipsEmptyRows,
    SkipsOnFailure,
    WithEvents
{
    use Importable;
    use SkipsFailures;
    use RemembersRowNumber;

    private Import $import;
    private string $error;

    public function __construct($import)
    {
        $this->import = $import;
    }

    public function model(array $row): Product
    {
        return new Product($this->getData($row));
    }

    private function getData(array $row): array
    {
        return [
            'name' => $row['name'],
            'code' => $row['code'],
            'price' => $row['price'],
            'description' => $row['description'],
            'discount' => $row['discount'],
            'stock' => $row['stock'],
            'status' => $this->assignStatus($row['status']),
            'slug' => $row['name'],
            'category_id' => $this->assignCategory($row['category']),
            'user_id' => auth()->id(),
        ];
    }

    private function assignCategory(string $category): int
    {
        return Category::select('id')->where('name', $category)->first()->id;
    }

    private function assignStatus(?string $status): string
    {
        return $status == null ? '0' : $status;
    }

    public function uniqueBy(): string
    {
        return 'code';
    }

    public function upsertColumns()
    {
        return ['name', 'price', 'description', 'discount', 'stock', 'status', 'category_id'];
    }

    public function batchSize(): int
    {
        return 10;
    }

    public function chunkSize(): int
    {
        return 10;
    }

    public function rules(): array
    {
        return array_merge(ProductImportRules::toArray(), [
            'status' => [
                'required', 
                Rule::in(ProductStatus::toArray())
            ],
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $this->import->update([
                    'records' => $this->getRowNumber(),
                ]);
            },

            AfterImport::class => function (AfterImport $event) {
                $this->import->update([
                    'status' => ExcelStatus::FINISHED,
                ]);
                dump($this->error);
            },
        ];
    }

    public function onFailure(Failure ...$failures): void
    {
        foreach ($failures as $failure) {
            $this->error = 'Fallo de importación en la fila no. ' . $failure->row() . ', id del producto ' . $failure->values()['id'] . '. Atributo: '
                . $failure->attribute() . ', error: ' . $failure->errors()[0];
        }
    }
}
