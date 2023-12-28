<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    function index(): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved contact us',
                'contactUsList' => ContactUs::where('active', 1)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting contact us!',
        ]);
    }

    function get($id): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved contact us',
                'contactUs' => ContactUs::findOrFail($id)
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting contact us!',
        ]);
    }

    function getLimited($limit): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved limited contact us',
                'contactUsList' => ContactUs::where('active', 1)->orderByDesc('id')->limit($limit)->get()
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting limited contact us!',
        ]);
    }

    function create(Request $request): JsonResponse
    {
        try {
            $newContactUs = new ContactUs();
            $this->getData($request, $newContactUs);

            $data = array(
                'name' => $newContactUs->name,
                'email' => $newContactUs->email,
                'phone' => $newContactUs->phone,
                'contactUsMessage' => $newContactUs->message,
                'timestamp' => date('Y-m-d H:i:s', strtotime($newContactUs->created_at))
            );

            Mail::send('mail.contact-us-email', $data, function ($message) {
                $message->to('rftl.charityrun@gmail.com', 'RFTL')->subject('Contact Us');
            });

            return response()->json([
                'error' => false,
                'message' => 'Your message has been recorded',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while recording your message!',
        ]);
    }

    public function delete($id): JsonResponse
    {
        try {
            $contactUs = ContactUs::findOrFail($id);
            $contactUs->update(['active' => false]);

            return response()->json([
                'error' => false,
                'message' => 'Successfully deleted contact us',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while deleting contact us!',
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $contactUs = ContactUs::findOrFail($id);
            $this->getData($request, $contactUs);

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated contact us',
                'contactUs' => $contactUs
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while updating contact us!',
        ]);
    }

    private function getData($request, $contactUs)
    {
        $contactUs->name = $request->name;
        $contactUs->phone = $request->phone;
        $contactUs->email = $request->email;
        $contactUs->message = $request->message;
        $contactUs->save();
    }
}
