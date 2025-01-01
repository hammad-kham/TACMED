<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use COM;

class HomeController extends Controller
{
    public function homePage()
    {
        //get all categories
        $categories = Category::all();
        $collections = Collection::all();
        return response()->json([
            'categories' => $categories,
            'collections' => $collections,
            'message' => 'all categories and collections',
            'status' => 'success',
        ], 200);
    }

    //------------X-------------------X
    //get all categories with view all 
    public function allCategories()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
            'message' => 'all categories',
            'status' => 'success',
        ], 200);
    }

    //X-------------X_-----------X
    //get all collections(blogs)
    public function allCollections()
    {
        $collections = Collection::all();
        return response()->json([
            'collections' => $collections,
            'message' => 'all collections',
            'status' => 'success',
        ], 200);
    }

    //X-------------X---------X
    //get collection by id
    public function showCollection($id)
    {
        // Retrieve the collection along with its associated category
        $collection = Collection::findOrFail($id);
        // Return the collection details as JSON
        return response()->json([
            'collection' => $collection,
            'status' => 'success',
            'message' => 'Collection retrieved successfully.',
        ]);
    }
    //X-------------X------------X
    public function showCategory($id)
    {
        // Find the category
        $category = Category::with('collections')->findOrFail($id);

        return response()->json([
            'categories' => $category,
            'message' => 'category retrieved successfully',
            'status' => 'success',

        ]);
    }
}
