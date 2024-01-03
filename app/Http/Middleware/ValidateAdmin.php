<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ValidateAdmin
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
        $token = null;
        if ($request->header('Authorization') && $request->header('Authorization') !== 'null') {
            $token = $request->header('Authorization');
        } elseif ($request->header('Token') && $request->header('Token') !== 'null') {
            $token = $request->header('Token');
        }
        if ($token) {
            $user = User::where('token', $token)->first();
            if ($user && $user->role_id === 1) {
                return $next($request);
            }
        }
        return response()->json([
            'error' => true,
            'message' => 'Not Authorized!',
        ]);
    }
}
