<?php

namespace App\Jobs\Exports;

use App\Constants\ExcelStatus;
use App\Models\Export;
use App\Notifications\ExportGenerated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CompletExportStatusJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Export $export;

    public function __construct(Export $export)
    {
        $this->export = $export;
    }

    public function handle(): void
    {
        DB::table('exports')->select('status')
            ->where('id', $this->export->id)
            ->update(['status' => ExcelStatus::FINISHED]);

        $this->export->user->notify(new ExportGenerated($this->export));
    }
}
