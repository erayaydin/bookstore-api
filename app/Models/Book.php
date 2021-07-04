<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Webpatser\Uuid\Uuid;

class Book extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'isbn', 'published_at', 'price'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('pdf')
            ->singleFile();

        $this->addMediaCollection('image')
            ->singleFile();
    }

    public function bookSections(): HasMany
    {
        return $this->hasMany(BookSection::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function getPdfAttribute(): string
    {
        return $this->getFirstMediaUrl('pdf');
    }

    public function getImageAttribute(): string
    {
        return $this->getFirstMediaUrl('image');
    }
}
