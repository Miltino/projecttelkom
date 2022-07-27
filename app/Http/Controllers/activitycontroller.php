<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class activitycontroller extends Controller
{
    public function activityLog() {

        $activityLog = ActivityLog::all();
        // dd($activityLog);
        return view('/loglogin',compact('activityLog'));
    }
}
