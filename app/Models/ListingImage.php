<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;
    protected $appends = ['src'];

    public static $image;

    public static function createImage($listingId, $filename)
    {
        self::$image = new ListingImage();
        self::$image->listing_id = $listingId;
        self::$image->filename = $filename;
        self::$image->save();
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    public function getSrcAttribute()
    {
        return asset("storage/{$this->filename}");
    }
}
