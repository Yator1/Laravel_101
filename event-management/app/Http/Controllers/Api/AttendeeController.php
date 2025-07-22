<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;

class AttendeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Attendee::class, 'attendee');
    }

    public function index(Event $event)
    {
        $attendees = $event->attendees()->latest();
        return AttendeeResource::collection(
            $attendees->paginate()
        );
    }

    public function store(Request $request, Event $event)
    {
        // adding a new attendee to an event
        $attendee = $event->attendees()->create([
            'event_id' => $event->id,
            'user_id' => $request->user()->id, // Assuming the user is authenticated
        ]);
        return new AttendeeResource($attendee);
    }

    public function show(Event $event, Attendee $attendee)
    {
        // showing a single attendee
        return new AttendeeResource($attendee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Attendee $attendee)
    {
        //
        // FacadesGate::authorize('delete-event', [$event, $attendee]);
        $attendee->delete();
        return response()->noContent();
    }
}
