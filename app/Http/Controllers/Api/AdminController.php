<?php

namespace App\Http\Controllers\Api;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function addToLog()
    {
        $data = \LogActivity::addToLog('Log');
        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }

    public function logActivity()
    {
        $logs = \LogActivity::LogActivityLists();
        return response()->json([
            'message' => 'success',
            'data' => $logs,
        ]);
    }
}
