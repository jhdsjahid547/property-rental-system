<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['rejected_at'];

    private static $offer;

    public static function createOffer($request, $id)
    {
        self::$offer = new Offer();
        self::$offer->bidder_id = Auth::id();
        self::$offer->listing_id = $id;
        self::$offer->amount = $request->amount;
        self::$offer->save();
        return self::$offer->id;
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    public function bidder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bidder_id');
    }

    public function scopeByMe(Builder $query): Builder
    {
        return $query->where('bidder_id', Auth::user()?->id);
    }

    public function scopeExcept(Builder $query, $id): Builder
    {
        return $query->where('id', '!=', $id);
    }
}
