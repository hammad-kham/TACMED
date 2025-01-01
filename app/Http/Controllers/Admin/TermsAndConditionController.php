<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function TermsAndCondition()
    {
        $data = TermsAndConditions::first();
        return view('backend.termsAndCondition', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate([
            'title' => 'required|string|max:25',
            'terms_and_conditions' => 'required|string|max:1000',
        ]);
        $data = TermsAndConditions::findOrFail($id);

        $data->update($input);

        return redirect()->route('admin.TermsAndCondition')->with('success', 'terms and condition updated successfully.');
    }
}
