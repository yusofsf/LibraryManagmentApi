<?php

use App\Enums\UserRole;
use App\Models\User;
use App\Notifications\ReservationWithdrawalNotification;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $users = User::where('role', UserRole::Member)->whereHas('reservations', function ($query) {
        $query->where('end_date', '<=', now()->format('Y-m-d H:i:s'));
    })->get();
    foreach ($users as $user) {
        $user->notify(new ReservationWithdrawalNotification($user));
    }
})->dailyAt('08:00');
