<?php

namespace App\Http\Controllers;

use App\TShirt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TShirtController extends Controller
{
    function index(): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved t-shirts',
                'tShirts' => TShirt::where('active', 1)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting t-shirts!',
        ]);
    }

    function get($id): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved t-shirt',
                'tShirt' => TShirt::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting t-shirt!',
        ]);
    }

    function getLimited($limit): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved limited t-shirts',
                'tShirts' => TShirt::where('active', 1)->orderByDesc('id')->limit($limit)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting limited t-shirts!',
        ]);
    }

    function create(Request $request): JsonResponse
    {
        try {
            $newTShirt = new TShirt();
            $this->getData($request, $newTShirt);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created t-shirt',
                'tShirt' => $newTShirt
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while creating t-shirt!',
        ]);
    }

    public function delete($id): JsonResponse
    {
        try {
            $tShirt = TShirt::findOrFail($id);
            $tShirt->update(['active' => false]);

            return response()->json([
                'error' => false,
                'message' => 'Successfully deleted t-shirt',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while deleting t-shirt!',
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $tShirt = TShirt::findOrFail($id);
            $this->getData($request, $tShirt);

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated t-shirt',
                'tShirt' => $tShirt
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while updating t-shirt!',
        ]);
    }

    private function getData($request, $tShirt)
    {
        $tShirt->size = $request->size;
        $tShirt->description = $request->description;
        $tShirt->quantity = $request->quantity;
        $tShirt->save();
    }
}
