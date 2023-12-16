<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PartnerController extends Controller
{
    function index(): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved partners',
                'partners' => Partner::where('active', 1)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting partners!',
        ]);
    }

    function get($id): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved partner',
                'partner' => Partner::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting partner!',
        ]);
    }

    function getLimited($limit): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved limited partners',
                'partners' => Partner::where('active', 1)->orderByDesc('id')->limit($limit)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting limited partners!',
        ]);
    }

    function create(Request $request): JsonResponse
    {
        try {
            $newPartner = new Partner();
            $this->getData($request, $newPartner);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created partner',
                'partner' => $newPartner
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while creating partner!',
        ]);
    }

    public function delete($id): JsonResponse
    {
        try {
            $partner = Partner::findOrFail($id);
            $partner->update(['active' => false]);

            return response()->json([
                'error' => false,
                'message' => 'Successfully deleted partner',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while deleting partner!',
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $partner = Partner::findOrFail($id);
            $this->getData($request, $partner);

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated partner',
                'partner' => $partner
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while updating partner!',
        ]);
    }

    private function getData($request, $partner)
    {
        $partner->name = $request->name;
        $partner->save();

        if ($request->file('image') && $request->file('image')->isValid()) {
            $extension = $request->image->extension();
            $request->image->storeAs('partners', $partner->id . '.' . $extension, 'images');
            $partner->image_extension = $extension;
            $partner->image_url = url('assets/images/partners/' . $partner->id . '.' . $extension);
            $partner->save();
        }
    }
}
