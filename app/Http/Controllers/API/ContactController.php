<?php

namespace App\Http\Controllers\API;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function ContactUs()
    {
        $contact = ContactUs::first();

        if (!$contact) {
            return response()->json([
                'status' => 'error',
                'message' => 'Contact information not found.'
            ], 404);
        }

        return response()->json([
            'contact info'=>$contact,
            'message'=>'contact info retrieved successfully.',
            'status' => 'success',
        ], 200);
    }
}
