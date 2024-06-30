<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class ListingController extends Controller
{
    public $listing;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //view('listing.index')
        Gate::authorize('viewAny', Listing::class);
        $filters = $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);
        return inertia('Listing/IndexListing', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()->filter($filters)->withoutSold()->paginate(10)->withQueryString()
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->listing = Listing::withTrashed()->find($id)->load('images');
        // if (Auth::user()->cannot('view', $this->listing)) {
        //     abort(403);
        // }
        $offer = !Auth::user() ? null : $this->listing->offers()->byMe()->first();
        Gate::authorize('view', $this->listing);
        return inertia('Listing/ShowListing', [
            'listing' => $this->listing,
            'offerMade' => $offer,
            'baseUrl' => URL::to('/') . '/'
        ]);
    }
}
