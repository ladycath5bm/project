<?php

namespace App\Jobs\Exports;

use App\Constants\ExcelStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CompletExportStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $export;

    public function __construct($export)
    {
        $this->export = $export;
    }

    public function handle(): void
    {
        DB::table('exports')->select('status')
            ->where('id', $this->export)
            ->update(['status' => ExcelStatus::FINISHED]);
    }
}
