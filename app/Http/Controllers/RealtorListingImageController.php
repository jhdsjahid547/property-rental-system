<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class RealtorListingImageController extends Controller
{
    public function create($id)
    {
        return inertia('Realtor/CreateImage', [
            'listing' => Listing::find($id)->load('images'),
            'baseUrl' => URL::to('/') . '/'
        ]);
    }

    public function store(Request $request, $id)
    {
        $listing = Listing::find($id);
        if ($request->hasFile('images')) {
            $request->validate([
                'images' => 'max:4',
                'images.*' => 'bail|mimes:jpg,png,jpeg|max:200'
            ], [
                'images.max' => 'Limit reached! Maximum 4 files upload at a time.'
            ]);
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                ListingImage::createImage($listing->id, $path);
            }
        }
        return redirect()->back()->with('success', 'Images Uploaded!');
    }

    public function destroy($listingId, $ImageId)
    {
        $image = ListingImage::find($ImageId);
        Storage::disk('public')->delete($image->filename);
        $image->delete();
        return redirect()->back()->with('success', 'Image was deleted!');
    }
}
