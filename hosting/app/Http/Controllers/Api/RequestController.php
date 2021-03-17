<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Log;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class RequestController extends Controller
{
    public function calculateFibonacci(Request $request)
    {
        $data = $request->all();
        if (!isset($data['number'])) {
            return response(['error' => 'need number for calculate'], 400);
        }
        return response(Helper::getFibonacci($data['number']));
    }
}
