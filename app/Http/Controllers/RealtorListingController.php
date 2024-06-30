<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class RealtorListingController extends Controller
{

    public $listing;

    public function index(Request $request)
    {
        Gate::authorize('viewAny', Listing::class);
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];
        return inertia('Realtor/IndexRealtor', [
            'filters' => $filters,
            'listings' => Auth::user()->listings()->filter($filters)->withCount('images')->withCount('offers')->paginate(5)->withQueryString()
        ]);
    }

    public function show($id)
    {
        $this->listing = Listing::find($id);
        Gate::authorize('show', $this->listing);
        return inertia('Realtor/ShowOffer', ['listing' => $this->listing->load('offers', 'offers.bidder')]);
    }

    public function create()
    {
        Gate::authorize('create', Listing::class);
        return inertia('Realtor/CreateListing');
    }

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
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was created!');
    }

    public function edit(string $id)
    {
        $this->listing = Listing::withTrashed()->find($id);
        Gate::authorize('update', $this->listing);
        return inertia('Realtor/EditListing', ['listing' => $this->listing]);
    }

    public function update(Request $request, string $id)
    {
        $this->listing = Listing::withTrashed()->find($id);
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
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was updated!');
    }

    public function destroy(string $id)
    {
        $this->listing = Listing::find($id);
        Gate::authorize('delete', $this->listing);
        $this->listing->deleteOrFail();
        return redirect()->back()->with('success', 'Listing was deleted!');
    }

    public function restore($id)
    {
        $this->listing = Listing::withTrashed()->find($id);
        Gate::authorize('restore', $this->listing);
        $this->listing->restore();
        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
