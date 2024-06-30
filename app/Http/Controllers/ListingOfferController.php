<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Gate;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Request $request, $id)
    {
        Gate::authorize('view', Listing::find($id));
        $request->validate([
            'amount' => 'bail|required|integer|min:1|max:20000000'
        ]);
        Offer::createOffer($request, $id);
        return redirect()->back()->with('success', 'Offer was made!');
    }    
}