<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function PrivacyPolicy()
    {
        $policy = Policy::first();
        return view('backend.privacyPolicy', compact('policy'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'privacy_policy' => 'required|string',
        ]);
        $policy = Policy::findOrFail($id);

        // Update the privacy policy using validated data
        $policy->update($input);

        // Redirect back with a success message
        return redirect()->route('admin.privacyPolicy')
            ->with('success', 'Privacy policy updated successfully.');
    }
}
