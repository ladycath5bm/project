<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    public function created(User $user)
    {
        Log::info('Se ha creado un usuario con id:', $this->info($user));
    }

    public function updated(User $user)
    {
        Log::info(['message, se ha actualizado un usuario'], [
            'user_id' => $user->getKey(),
        ]);
    }
    public function deleted(User $user)
    {
        Log::warning(['message, se ha eliminado un usuario'], [
            'user_id' => $user->getKey(),
        ]);
    }

    protected function info(User $user): array
    {
        return [
            'user_id' => $user->getKey(),
        ];
    }
}
