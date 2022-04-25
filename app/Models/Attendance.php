<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Attendance extends Model
{
    use HasFactory;

    public static function getAttendance()
    {
        $id = Auth::id();

        $dt = new Carbon();
        $date = $dt->toDateString();

        $attendance = Attendance::where('user_id', $id)->where('work_date', $date)->first();

        return $attendance;
    }


    public function user()
    {
        // $userid = user::all();
        return $this->belongsTo('App\User');
    }

    public static function indexAttendance($attendances)
    {

        foreach ($attendances as $index => $attendance) {
            $rests = $attendance->rests;
            $start_at = new Carbon($attendance->workstart_time);
            // dd($start_at);
        }
        return $attendances;
    }
    
}
