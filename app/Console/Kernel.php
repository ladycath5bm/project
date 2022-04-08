<?php

namespace App\Console;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('consult:payment')
            ->everyMinute()
            ->when(
                function () {
                    $order = Order::latest()->first();
                    
                    if ($order->status == 'PENDING') {
                        info('order PENDING, consulting ...');
                        return true;
                    } elseif ($order->status == 'APPROVED') {
                        Cart::destroy();
                        Log::info('shopping cart remove, payment aproved');
                        info('shopping cart remove, transaction aproved');
                        return false;
                    } else {
                        return false;
                    }
                }
            );
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
