<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        return inertia('Realtor/IndexRealtor', ['listings' => Auth::user()->listings()->filter($filters)->get()]);
    }

    public function destroy(string $id)
    {
        $this->listing = Listing::find($id);
        Gate::authorize('delete', $this->listing);
        $this->listing->deleteOrFail();
        return redirect()->back()->with('success', 'Listing was deleted!');
    }
}
