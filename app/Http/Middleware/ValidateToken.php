<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
            $user = User::where('token', $request->header('Authorization'))->first();
            if ($user) {
                return $next($request);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'Not Authorized!',
        ]);
    }
}
