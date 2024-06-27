<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
            'listings' => Listing::mostRecent()->filter($filters)->paginate(10)->withQueryString()
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->listing = Listing::find($id);
        // if (Auth::user()->cannot('view', $this->listing)) {
        //     abort(403);
        // }
        Gate::authorize('view', $this->listing);
        return inertia('Listing/ShowListing', ['listing' => $this->listing]);
    }
}
