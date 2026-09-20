<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Order;

#[Signature('app:delete-expired-orders')]
#[Description('Elimina gli ordini cancellati da più di sette giorni')]
class DeleteExpiredOrders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
       Order::where("cancelled_at", "<", now()->subMinutes(1))->where("status","cancelled")->delete();
        
    }
}
