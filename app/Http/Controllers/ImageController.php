<?php

namespace App\Http\Controllers;
use App\Models\Image;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        dd($request);
        $request->validate([
            'image' => 'required|image|max:2048', // 2MB max
        ]);

        $image = $request->file('image');
        $data = file_get_contents($image);

        $imageModel = Image::create([
            'name' => $image->getClientOriginalName(),
            'mime_type' => $image->getClientMimeType(),
            'data' => base64_encode($data), // Convert to base64 for storage
        ]);

        return response()->json(['id' => $imageModel->id, 'message' => 'Image uploaded successfully']);
    }
}
