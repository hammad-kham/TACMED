<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function category()
    {
        $categories = Category::simplePaginate(15);
        return view('backend.category', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $input = $request->all();
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        //handle image
        if ($request->hasFile('image')) {
            //upload new file
            $extension = $request->image->extension();
            $filename = time() . "_." . $extension;
            $request->image->move(public_path('backend/img/user'), $filename);
            $input['image'] = $filename;
        }

        // Create a new category
        Category::create($input);
        // Redirect back with a success message
        return redirect()->route('admin.category')->with('success', 'Category added successfully');
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);
        $input = $request->all();

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Check if there is an existing image, and delete it
            if ($category->image) {
                // Get the path and delete the old image file
                $url_path = parse_url($category->image, PHP_URL_PATH);
                $basename = pathinfo($url_path, PATHINFO_BASENAME);
                $file_old = public_path("backend/img/user/$basename");

                if (file_exists($file_old)) {
                    unlink($file_old);
                }
            }

            // Generate a unique filename for the new image
            $extension = $request->image->extension();
            $filename = time() . "_." . $extension;
            // Move the uploaded image to the specified directory
            $request->image->move(public_path('backend/img/user'), $filename);
            // Update the image field in the input array
            $input['image'] = $filename;
        }

        // Update the category with the new data
        $category->update($input);

        // Redirect back with a success message
        return redirect()->route('admin.category')->with('success', 'Category updated successfully');
    }



    public function destroy($id)
    {
        // dd($id);
        // Find the category by ID
        $category = Category::findOrFail($id);
        // Check if the category has an associated image and delete the file if it exists
        if ($category->image) {
            // Path to the image file
            $file_path = public_path("backend/img/user/" . $category->image);
            // Check if the file exists before attempting to delete it
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Delete the category record from the database
        $category->delete();

        // Redirect back to the category list with a success message
        return redirect()->route('admin.category')->with('success', 'Category deleted successfully');
    }
}
