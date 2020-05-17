<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use Illuminate\Http\Request;

class RequestLogMiddleware 
 {
 public function handle(Request $request, Closure $next)
 {
     Log::info('ApiLog done===========================');
     Log::info('URL: ' . $request->fullUrl());
     Log::info('Method: ' . $request->getMethod());
     Log::info('IP Address: ' . $request->getClientIp());
        return $next($request);
 }

 }
