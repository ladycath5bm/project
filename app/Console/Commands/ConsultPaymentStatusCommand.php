<?php

namespace App\Console\Commands;

use App\Jobs\ConsultPaymentStatusJob;
use App\Models\User;
use Illuminate\Console\Command;

class ConsultPaymentStatusCommand extends Command
{
    protected $signature = 'consult:payment';

    protected $description = 'This command consult the transaction status for payments';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ConsultPaymentStatusJob::dispatchSync();
        info('command for consult dispatch');
    }
}
