<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rest;
use App\Models\Attendance;
use Carbon\Carbon;



class RestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function startRest()
    {

        // $dt = new Carbon();
        // $time = $dt->toTimeString();

        $attendance = Attendance::getAttendance();

        $attendance_id = $attendance->id;

        // Rest::create([
        //     'attendance_id' => $attendance_id,
        //     'reststart_time' => $time,
        // ]);



        Rest::insert(['attendance_id' => $attendance_id, 'reststart_time' => date('H:i:s')]);

        $user = Auth::user();

        return view('index', compact('user'));
    }

    public function endRest()
    {
        $attendance = Attendance::getAttendance();

        $attendance_id = $attendance->id;

        // Rest::update(['attendance_id' => $attendance_id, 'restend_time' => date('H:i:s')]);

        Rest::where('attendance_id', '=', $attendance_id)
            ->latest('reststart_time')
            ->first()
            ->update(['restend_time' => date('H:i:s')]);

        $user = Auth::user();
        return view('index', compact('user'));
    }





}
