<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    
    private static $listing;

    private static function extracted($request)
    {
        self::$listing->beds = $request->beds;
        self::$listing->baths = $request->baths;
        self::$listing->area = $request->area;
        self::$listing->city = $request->city;
        self::$listing->street = $request->street;
        self::$listing->code = $request->code;
        self::$listing->street_nr = $request->street_nr;
        self::$listing->price = $request->price;
        self::$listing->save();
    }

    public static function createListing($request)
    {
        self::$listing = new Listing();
        self::extracted($request);
    }

    public static function updateListing($id, $request)
    {
        self::$listing = Listing::find($id);
        self::extracted($request);
    }
}
