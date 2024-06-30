<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $sortable = ['price', 'created_at'];
    
    private static $listing;

    private static function extracted($request)
    {
        self::$listing->user_id = $request->user()->id;
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

    public function owner(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function scopeWithoutSold(Builder $query): Builder
    {
        //return $query->doesntHave('offers')->orWhereHas('offers', fn (Builder $query) => $query->whereNull('accepted_at')->whereNull('rejected_at'));
        //same result simplify to this blew
        return $query->whereNull('sold_at');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
                        $filters['priceFrom'] ?? false,
                        fn ($query, $value) => $query->where('price', '>=', $value)
                    )->when(
                        $filters['priceTo'] ?? false,
                        fn ($query, $value) => $query->where('price', '<=', $value)
                    )->when(
                        $filters['beds'] ?? false,
                        fn ($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
                    )->when(
                        $filters['baths'] ?? false,
                        fn ($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
                    )->when(
                        $filters['areaFrom'] ?? false,
                        fn ($query, $value) => $query->where('area', '>=', $value)
                    )->when(
                        $filters['areaTo'] ?? false,
                        fn ($query, $value) => $query->where('area', '<=', $value)
                    )->when(
                        $filters['deleted'] ?? false,
                        fn ($query, $value) => $query->withTrashed()
                    )->when(
                        $filters['by'] ?? false,
                        fn ($query, $value) => 
                        !in_array($value, $this->sortable) ? $query :
                        $query->orderBy($value, $filters['order'] ?? 'desc')
                    );
    }
}
