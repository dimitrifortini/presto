<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\User;


class AssignAdminRole extends Command
{

    protected $signature = "app:assign-admin-role {email}";
    protected $description = 'Rende amministratore un utente';
    public function handle()
    {
        $user = User::where("email", $this->argument("email"))->first();
        if (!$user) {
            $this->error("Utente non trovato");
            return;
        }
        $user->is_admin = true;
        $user->is_revisor = true;
        $user->save();
        $this->info("l'utente {$user->name} è stato reso amministratore");
    }
}
