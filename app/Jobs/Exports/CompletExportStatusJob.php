<?php

namespace App\Jobs\Exports;

use App\Models\Export;
use Illuminate\Bus\Queueable;
use App\Constants\ExcelStatus;
use Illuminate\Support\Facades\DB;
use App\Notifications\ExportGenerated;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CompletExportStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Export $export;

    public function __construct(Export $export)
    {
        $this->export = $export;
    }

    public function handle(): void
    {
        DB::table('exports')->select('status')
            ->where('id', $this->export)
            ->update(['status' => ExcelStatus::FINISHED]);

        $this->export->user->notify(new ExportGenerated($this->export));
    }
}
