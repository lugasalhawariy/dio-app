<?php

namespace App\Http\Middleware;

use App\Helpers\JsonResponse;
use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->all()['key'] ?? null;
        $personal_token = ApiToken::where('token', $token)->first();

        if(!$personal_token || $personal_token->expires_at < now()) {
            return JsonResponse::error('Unauthorized Access', 401);
        }

        return $next($request);
    }
}
