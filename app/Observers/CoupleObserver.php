<?php

namespace App\Observers;

use App\Models\couple;
use App\Models\User;
class CoupleObserver
{
    /**
     * Handle the couple "created" event.
     */
    public function created(couple $couple): void
    {
        $user1 = User::find($couple->user1_id);
        $user2 = User::find($couple->user2_id);

        $user1->update(['connection_token' => null]);
        $user2->update(['connection_token' => null]);

        $user1->removeRole('single');
        $user2->removeRole('single');

        $user1->assignRole('couple');
        $user2->assignRole('couple');

    }

    /**
     * Handle the couple "updated" event.
     */
    public function updated(couple $couple): void
    {
        //
    }

    /**
     * Handle the couple "deleted" event.
     */
    public function deleted(couple $couple): void
    {
        //
    }

    /**
     * Handle the couple "restored" event.
     */
    public function restored(couple $couple): void
    {
        //
    }

    /**
     * Handle the couple "force deleted" event.
     */
    public function forceDeleted(couple $couple): void
    {
        //
    }
}
