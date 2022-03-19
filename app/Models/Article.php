<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->watermark(public_path('assets/images/logo.png'))
            ->watermarkHeight(30, Manipulations::UNIT_PERCENT)    // 50 percent height
            ->watermarkWidth(30, Manipulations::UNIT_PERCENT) // 100 percent width
            ->watermarkPadding(10)
            ->watermarkOpacity(50)
            ->sharpen(10);

        $this->addMediaConversion('resized')
            ->width(800)
            ->height(500)
            ->watermark(public_path('assets/images/logo.png'))
            ->watermarkHeight(30, Manipulations::UNIT_PERCENT)    // 50 percent height
            ->watermarkWidth(30, Manipulations::UNIT_PERCENT) // 100 percent width
            ->watermarkPadding(10)
            ->watermarkOpacity(50)
            ->sharpen(10);
    }
}
