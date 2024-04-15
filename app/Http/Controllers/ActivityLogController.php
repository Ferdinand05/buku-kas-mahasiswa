<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {

        return view('log.index', ['logs' => Activity::latest()->get()]);
        // return Activity::all();
    }
}
