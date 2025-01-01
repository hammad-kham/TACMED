<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    public function blogs()
    {
        $categories = Category::simplePaginate(15);
        $collections = Collection::simplePaginate(15);
        // dd($collections);
        return view('backend.blogs', compact('collections', 'categories'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $validator = Validator::make(
            $input,
            [
                'category_id' => 'required|exists:categories,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );
        //handle image
        if ($request->hasFile('image')) {
            //upload new file
            $extension = $request->image->extension();
            $filename = time() . "_." . $extension;
            $request->image->move(public_path('backend/img/user'), $filename);
            $input['image'] = $filename;
        }

        Collection::create($input);
        // Redirect back with a success message
        return redirect()->route('admin.blogs')->with('success', 'blog added successfully');
    }
    //X------------X------------X
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // dd($input);
        $validator = Validator::make(
            $input,
            [
                'category_id' => 'required|exists:categories,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );

        $collection = Collection::findOrFail($id);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Check if there is an existing image, and delete it
            if ($collection->image) {
                // Get the path and delete the old image file
                $url_path = parse_url($collection->image, PHP_URL_PATH);
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

        $collection->update($input);
        return redirect()->route('admin.blogs')->with('success', 'Collection updated successfully');
    }
    //X-----------X-----------X
    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);

        if ($collection->image) {
            // Path to the image file
            $file_path = public_path("backend/img/user/" . $collection->image);
            // Check if the file exists before attempting to delete it
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $collection->delete();
        return redirect()->route('admin.blogs')->with('success','Blog deleted Successfully.');
    }



}
