<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\AboutUsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AboutUsController extends Controller
{
    //Get About Us Page Fucntion
    public function getAboutUsPage()
    {
        $user = Auth::guard('user')->user();
        $about_us = AboutUs::first();
        $images = AboutUsImage::all();

        return view('about_us.about_us', compact('user', 'about_us', 'images'));
    }

    //Edit About Us Page Function
    public function editAboutUsPage()
    {
        $about_us = AboutUs::first();
        $images = AboutUsImage::all();

        return view('about_us.edit_about_us', compact('about_us', 'images'));
    }

    //Edit About Us Function
    public function editAboutUs(Request $request)
    {
        $about_us = AboutUs::first();
        $request->validate([
            'details' => 'required',
        ]);

        $about_us->update([
            'details' => $request->details,
        ]);

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->storePublicly('AboutUsImages', 'public');
                AboutUsImage::create([
                    'image' => 'storage/' . $path,
                ]);
            }
        }

        return redirect('/about_us')->with('success', 'updated successfully');
    }

    //Delete About Us Image Function
    public function deleteAboutUsImage(AboutUsImage $image)
    {
        if (File::exists($image->image)) {
            File::delete($image->image);
        }
        $image->delete();
    }
}
