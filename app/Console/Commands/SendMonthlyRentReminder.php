<?php

namespace App\Console\Commands;

use App\Models\MonthlyRent;
use App\Notifications\MonthlyRentNotification;
use Illuminate\Console\Command;

class SendMonthlyRentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-monthly-rent-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rents = MonthlyRent::where('status', 'UNPAID')
            ->whereDate('due_date', today())
            ->get();

        foreach ($rents as $rent) {
            $rent->stallContract->stallOccupant->vendor->user->notify(new MonthlyRentNotification($rent));
        }

        $rents = MonthlyRent::where('status', 'UNPAID')
            ->whereDate('due_date', today()->addDays(7))
            ->get();

        foreach ($rents as $rent) {
            $rent->stallContract->stallOccupant->vendor->user->notify(new MonthlyRentNotification($rent));
        }

        $this->info('Reminders sent successfully!');
    }
}
