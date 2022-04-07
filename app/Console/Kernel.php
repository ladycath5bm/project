<?php

namespace App\Console;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // $schedule->command('inspire')->hourly();

        $schedule->command('consult:payment')
            ->everyMinute()
            ->when(
                function () {
                    $order = Order::latest()->first();
                    //info('helou');
                    if ($order->status == 'PENDING') {
                        info('order PENDING, consulting ...');
                        return true;
                    } elseif ($order->status == 'APPROVED') {
                        Cart::destroy();
                        return false;
                    }
                    else {
                        return false;
                    }
                }
            );
        //info("holi");
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
