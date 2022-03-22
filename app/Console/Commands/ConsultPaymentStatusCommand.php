<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Order;
use Illuminate\Console\Command;
use Database\Factories\OrderFactory;
use App\Jobs\ConsultPaymentStatusJob;

class ConsultPaymentStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consult:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commnd consult the transaction status for payments proccess';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ConsultPaymentStatusJob::dispatchSync();
        //User::factory(1)->create();
        //$this->info('holi');
        info("log message");
    }
}
