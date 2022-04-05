<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;


class AttendanceController extends Controller
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
    public function getIndex()
    {
        $user = Auth::user();
        $attendance = Attendance::where('work_date', '=', date('y/m/d'))
            ->where('user_id', '=', \Auth::id())->get();


        // dd($attendance);

        if (count($attendance) <= 0) {
            return view('index', compact('user'));
        } else {
            return view('index', compact('user', 'attendance'));
        }
    }

    public function startAttendance()
    {

        Attendance::insert(['user_id' => \Auth::id(), 'work_date' => date('y/m/d'), 'workstart_time' => date('H:i:s')]);
        $user = Auth::user();

        $attendance = Attendance::where('work_date', '=', date('y/m/d'))
            ->where('user_id', '=', \Auth::id())->get();

        // dd($attendance);

        if (count($attendance) <= 0) {
            return view('index', compact('user'));
        } else {
            return view('index', compact('user', 'attendance'));
        }
    }

    public function endAttendance()
    {
        Attendance::where('user_id', '=', \Auth::id())
            ->where('work_date', '=', date('y/m/d'))
            ->update(['workend_time' => date('H:i:s')]);
        $user = Auth::user();

        $endattendance = Attendance::where('work_date', '=', date('y/m/d'))
            ->where('user_id', '=', \Auth::id())->get();


        // dd($attendance);

        if (count($endattendance) <= 0) {
            return view('index', compact('user'));
        } else {
            return view('index', compact(
                'user',
                'endattendance'
            ));
        }
    }

    public function getAttendance()
    {
        $attendance = Attendance::select('attendances.*')
            ->where('work_date', '=', date('y/m/d'))
            ->get();
        // dd($attendance);

        return view('attendance', compact('attendance'));
    }
}
