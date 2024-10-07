<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{

    public function handle(Request $request, Closure $next, string $permission): Response
    {
      // abort_unless($request->user()->can($permission), /*Response::HTTP_FORBIDDEN*/403);
        return $next($request);
    }
}
