<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('event_permission', ['except' => ['store','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allEvents()
    {
    	$user = Auth::user();
    	$events = Event::orderBy('created_at', 'desc')->get();

        return view('events.all-events', compact('events','user'));
    }

    public function takingPartEvent(Request $request)
    {
        EventAttendance::create([
           'event_id'   =>  $request->event_id,
           'user_id'    =>  $request->user_id,
            'status'    =>  0,
        ]);

        return back();

    }

    public function notTakingPartEvent(Request $request)
    {

        EventAttendance::where([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
        ])->delete();

        return back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {

        $this->validate($request,[
            'title' => 'required|min:5',
            'place' => 'required|min:5',
        ], [
            'required' => 'Pole jest wymagane',
            'min' => 'Pole musi mieć minimum :min znaków',
        ]);

        $event::create([
        	'user_id' => Auth::id(),
	        'title'   => $request->title,
	        'place'   => $request->place,
	        'start_date'   => $request->start_date,
	        'end_date'   => $request->end_date,
	        'visibility'   => $request->visibility,
	        'description'   => $request->description,
	        'website'   => $request->website,
	        'event_img'   => $request->event_img
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$event = Event::findOrFail($id);

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Event $event)
    {
	    $this->validate($request,[
		    'title' => 'required|min:5',
		    'place' => 'required|min:5',
	    ], [
		    'required' => 'Pole jest wymagane',
		    'min' => 'Pole musi mieć minimum :min znaków',
	    ]);

	    $event = Event::where([
		    'id' => $id,
	    ]);

	    $event->update([
		    'user_id' => Auth::id(),
		    'title'   => $request->title,
		    'place'   => $request->place,
		    'start_date'   => $request->start_date,
		    'end_date'   => $request->end_date,
		    'visibility'   => $request->visibility,
		    'description'   => $request->description,
		    'website'   => $request->website,
		    'event_img'   => $request->event_img
	    ]);

	    return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
