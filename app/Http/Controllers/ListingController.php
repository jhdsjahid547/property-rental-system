<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Listing::class);
        return inertia('Listing/CreateListing');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Listing::class);
        Validator::make($request->all(), [
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'street' => 'required',
            'code' => 'required',
            'street_nr' =>'required|min:1|max:1000',
            'price' => 'required|integer|min:1|max:20000000'
        ])->validate();
        //if validation failed automatic return error not work blew operations.
        Listing::createListing($request);
        //$request->user()->listings()->save($listing);
        return redirect()->route('listing.index')->with('success', 'Listing was created!');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->listing = Listing::find($id);
        Gate::authorize('update', $this->listing);
        return inertia('Listing/EditListing', ['listing' => $this->listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->listing = Listing::find($id);
        Gate::authorize('update', $this->listing);
        Validator::make($request->all(), [
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'street' => 'required',
            'code' => 'required',
            'street_nr' =>'required|min:1|max:1000',
            'price' => 'required|integer|min:1|max:20000000'
        ])->validate();
        Listing::updateListing($id, $request);
        return redirect()->route('listing.index')->with('success', 'Listing was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $this->listing = Listing::find($id);
    //     Gate::authorize('delete', $this->listing);
    //     $this->listing->delete();
    //     return redirect()->back()->with('success', 'Listing was deleted!');
    // }
}
