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
}
