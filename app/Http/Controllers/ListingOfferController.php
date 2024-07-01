<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Gate;
use App\Models\Listing;
use App\Models\User;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Request $request, $id)
    {
        $listing = Listing::find($id);
        Gate::authorize('view', $listing);
        $request->validate([
            'amount' => 'bail|required|integer|min:1|max:20000000'
        ]);
        $offerId = Offer::createOffer($request, $id);
        $listing->owner->notify(new OfferMade($offerId));
        //similer to if return self::$offer
        // $user = User::find($offer->bidder_id);
        // $user->notify(new OfferMade($offer->id));
        return redirect()->back()->with('success', 'Offer was made!');
    }    
}