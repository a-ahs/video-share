<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'length', 'descriptions', 'url', 'thumbnail', 'slug', 'category_id'
    ];

    public function getLengthInHumanAttribute()
    {
        return gmdate('i:s', $this->attributes['length']);
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Verta($value))->formatDifference(verta());
    }

    public function relatedVideos(int $count = 6)
    {
        return $this->category->getRandomVideos($count, $this->id);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }
}
