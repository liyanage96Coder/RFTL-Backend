<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    function index(): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved gallery',
                'gallery' => Gallery::where('active', 1)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting gallery!',
        ]);
    }

    function get($id): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved gallery',
                'gallery' => Gallery::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting gallery!',
        ]);
    }

    function getLimited($limit): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved limited gallery',
                'gallery' => Gallery::where('active', 1)->orderByDesc('id')->limit($limit)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting limited gallery!',
        ]);
    }

    function create(Request $request): JsonResponse
    {
        try {
            $newGallery = new Gallery();
            $this->getData($request, $newGallery);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created gallery',
                'gallery' => $newGallery
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while creating gallery!',
        ]);
    }

    public function delete($id): JsonResponse
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->update(['active' => false]);

            return response()->json([
                'error' => false,
                'message' => 'Successfully deleted gallery',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while deleting gallery!',
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $this->getData($request, $gallery);

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated gallery',
                'gallery' => $gallery
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while updating gallery!',
        ]);
    }

    private function getData($request, $gallery)
    {
        $gallery->tag = $request->tag;
        $gallery->save();

        if ($request->file('image') && $request->file('image')->isValid()) {
            $extension = $request->image->extension();
            $request->image->storeAs('gallery', $gallery->id . '.' . $extension, 'images');
            $gallery->image_extension = $extension;
            $gallery->image_url = url('assets/images/gallery/' . $gallery->id . '.' . $extension);
            $gallery->save();
        }
    }
}
