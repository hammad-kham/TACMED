<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\OnboardingPage;
use App\Http\Controllers\Controller;

class OnboardingController extends Controller
{
    public function getAllPages()
    {
        // Retrieve all onboarding pages ordered by the 'order' field
        $pages = OnboardingPage::orderBy('order')->get();
        // $pages = OnboardingPage::orderBy('order','DESC')->get();

        return response()->json([
            'pages' => $pages,
            'message'=>'all onboarding page',
            'status'=>'success'

        ],200);
    }
}
