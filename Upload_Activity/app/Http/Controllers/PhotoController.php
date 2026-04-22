<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    public function create()
    {
        $photos = Photo::latest()->get();
        return view('upload', compact('photos'));
    }

    public function storeSingle(Request $request)
    {
        // Simple validation to bypass the "failed to upload" block
        $request->validate([
            'image' => 'required|max:10240', // Limit to 10MB
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
                        $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            $file->move(public_path('images'), $filename);

            Photo::create(['image' => $filename]);

            return back()->with('success', 'Single image uploaded!');
        }

        return back()->withErrors(['image' => 'The server did not receive the file. Try a smaller image.']);
    }

    public function storeMultiple(Request $request)
    {
    $request->validate([
        'images' => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:9000',
        ]);
            if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            $image->move(public_path('images'), $name);
            
            Photo::create(['image' => $name]);
        }
    }

        return back()->with('success', 'Multiple Upload Image is Successful');
    }
    

    public function destroy($id)
{
    $photo = Photo::findOrFail($id);
    $filePath = public_path('images/' . $photo->image);
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    $photo->delete();
    return back()->with('success', 'Image deleted successfully!');
}
}