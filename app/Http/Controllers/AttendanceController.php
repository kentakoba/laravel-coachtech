<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

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
        // 以下の記載だと今日で固定されている。
        $dt = Carbon::today()->format('Y-m-d');

        $attendances = Attendance::select(
            [
                'u.name',
                'a.work_date',
                'a.workstart_time',
                'a.workend_time',
                'a.user_id',
                Attendance::raw('TIMEDIFF(a.workend_time,a.workstart_time) as work_time'),
                // 'r.reststart_time',
                // 'r.restend_time',
                Attendance::raw('sec_to_time(SUM(TIMEDIFF(r.restend_time,r.reststart_time))) as rest_time'),
            ]
        )
            ->from('attendances as a')
            ->join('users as u', function ($join) {
                $join->on('u.id', '=', 'a.user_id');
            })
            ->join('rests as r', function ($join) {
                $join->on('a.id', '=', 'r.attendance_id');
            })
            // 以下の記載で本日分を取得できる。
            ->where('work_date', '=', date('y/m/d'))
            // 以下、なぜかselectで指定した項目を全て記載すると取得できた
            ->groupBy('a.user_id', 'u.name', 'a.work_date', 'a.workstart_time', 'a.workend_time')
            // 一旦ぺージネートを１０行にしている
            ->paginate(1);
        // ->get();paginateがgetの代替をする
        return view('attendance', compact('attendances', 'dt'));
    }



    // 日付変更プログラム
    public function changeDate(Request $request)
    {

        if ($request->input('before') == 'before') {
            $dt = date('Y-m-d', strtotime('-1day', strtotime($request->input('date'))));
        }

        if ($request->input('next') == 'next') {
            $dt = date('Y-m-d', strtotime('+1day', strtotime($request->input('date'))));
        }


        // dd($dt);
        // 以下の記載だと今日で固定されている。
        // $dt = Carbon::today();


        $attendances = Attendance::select(
            [
                'u.name',
                'a.work_date',
                'a.workstart_time',
                'a.workend_time',
                'a.user_id',
                Attendance::raw('TIMEDIFF(a.workend_time,a.workstart_time) as work_time'),
                // 'r.reststart_time',
                // 'r.restend_time',
                Attendance::raw('sec_to_time(SUM(TIMEDIFF(r.restend_time,r.reststart_time))) as rest_time'),
            ]
        )
            ->from('attendances as a')
            ->join('users as u', function ($join) {
                $join->on('u.id', '=', 'a.user_id');
            })
            ->join('rests as r', function ($join) {
                $join->on('a.id', '=', 'r.attendance_id');
            })
            // 以下の記載で変数の日付をを取得できる。
            ->where('work_date', '=', $dt)
            // 以下、なぜかselectで指定した項目を全て記載すると取得できた
            ->groupBy('a.user_id', 'u.name', 'a.work_date', 'a.workstart_time', 'a.workend_time')
            // 一旦ぺージネートを１０行にしている
            ->paginate(1);
        // ->get();paginateがgetの代替をする
        // dd($attendances);

        // dd($dt);

        return view('attendance', compact('attendances', 'dt'));
    }
}
