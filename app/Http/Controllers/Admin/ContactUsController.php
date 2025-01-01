<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function ContactUs()
    {
        $contact = ContactUs::first();
        // dd($contact);
        return view('backend.contactUs',compact('contact'));
    }
    //X--------X----------X
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // Validate the incoming data
        $validatedData = $request->validate([
            'email' => 'nullable|email',
            'phone_no' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:500',
        ]);

        // Find the contact record by ID
        $contact = ContactUs::findOrFail($id);

        // Update the contact information
        $contact->update($input);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Contact information updated successfully.');
    }
}
