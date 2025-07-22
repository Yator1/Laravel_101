<?php

namespace App\Providers;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // //
        // Gate::define('update-event', function($user, Event $event) {
        //     // Assuming the user can update the event if they are the creator
        //     return $user->id === $event->user_id;
        // });

        // Gate::define('delete-event', function($user, Event $event, Attendee $attendee){
        //     // Assuming the user can delete the event if they are the creator or an attendee
        //     return $user->id === $event->user_id || $user->id === $attendee->user_id;
        // });
    }
}
