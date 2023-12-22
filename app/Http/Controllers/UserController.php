<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    function index(): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved users',
                'users' => User::where('active', 1)->with('role')->get(),
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting users!',
        ]);
    }

    function get($id): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved user',
                'user' => User::where('id', $id)->with(['role'])->first()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting user!',
        ]);
    }

    function create(Request $request): JsonResponse
    {
        try {
            if (User::firstWhere('email', $request->get('email'))) {
                return response()->json([
                    'error' => true,
                    'message' => 'Email already exists!'
                ]);
            }

            $newUser = new User;
            $this->getData($request, $newUser);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created user',
                'user' => $newUser,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while creating user!',
        ]);
    }

    public function delete($id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->update(['active' => false]);

            return response()->json([
                'error' => false,
                'message' => 'Successfully deleted user',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while deleting user!',
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $this->getData($request, $user);

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated user',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while updating user!',
        ]);
    }

    private function getData($request, $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->save();
    }
}
