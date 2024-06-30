<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Gate;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke($id)
    {
        
        $offer = Offer::find($id);
        Gate::authorize('update', $offer->listing);
        $offer->accepted_at = now();
        $offer->save();
        $offer->listing->sold_at = now();
        $offer->listing->save();
        //reject all other
        $offer->listing->offers()->except($offer->id)->update(['rejected_at' => now()]);
        return redirect()->back()->with('success', "Offer #{$offer->id}, accepted!");
    } 
}
