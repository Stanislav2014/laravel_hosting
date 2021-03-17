<?php

namespace App\Http\Controllers;

use App\Models\Api\Log;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function log()
    {
        return view('admin', ['logs' => Log::all()]);
    }

    public function logClear()
    {
        Log::truncate();
        return redirect()->route('admin.log', ['logs' => []]);
    }
}
