<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\HomeModel;   

class FullCalendarController extends Controller
{

    public function __construct(){
        $this->calendarModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        // on page load this ajax code block will be run
        if ($request->ajax()) {

            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        $data = [
            'info_user' => $this->calendarModel->KaryawanData(),
        ];

        return view('v_calendar',$data);
    }

    /**
     * This method is to handle event ajax operation
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
        switch ($request->type) {

            // For add event
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            // For update event
            case 'update':
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            // For delete event
            case 'delete':
                $event = Event::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                break;
        }
    }
}
