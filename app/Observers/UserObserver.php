<?php

namespace App\Observers;

use App\Models\User;
use App\Models\ActivityLog;

class UserObserver
{
    public function updated(User $user)
    {
        if ($user->wasChanged('employment_status')) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'employment_status_updated',
                'details' => json_encode([
                    'old_status' => $user->getOriginal('employment_status'),
                    'new_status' => $user->employment_status,
                    'updated_at' => now()
                ])
            ]);
        }

        if ($user->wasChanged('employment_type')) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'employment_type_updated',
                'details' => json_encode([
                    'old_type' => $user->getOriginal('employment_type'),
                    'new_type' => $user->employment_type,
                    'updated_at' => now()
                ])
            ]);
        }
    }
}
