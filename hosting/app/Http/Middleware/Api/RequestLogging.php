<?php

namespace App\Http\Middleware\Api;

use App\Models\Api\Log;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response)
    {
        $dataRequest = $request->all();
        $dataResponse = $response;
        Log::create([
                'endpoint' => $request->path(),
                'verb' => $request->method(),
                'request' => json_encode($dataRequest),
                'response' => json_encode($dataResponse)
            ]
        );
    }
}
