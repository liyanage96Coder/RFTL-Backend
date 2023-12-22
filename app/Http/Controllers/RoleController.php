<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    function index(): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved roles',
                'roles' => Role::where('active', 1)->get(),
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting roles!',
        ]);
    }
}
