<?php

namespace App\Models;

use App\Filters\VideoFilter;
use App\Models\Traits\likeable;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory, likeable, SoftDeletes;

    protected $fillable = [
        'name', 'length', 'descriptions', 'path', 'thumbnail', 'slug', 'category_id', 'user_id'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOwnerNameAttribute()
    {
        return $this->user?->name;
    }

    public function getOwnerAvatarAttribute()
    {
        return $this->user?->gravatar;
    }

    public function Comments()
   {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
   }

   public function getVideoPathAttribute()
   {
        // return Storage::url($this->url);
        return '/storage/' . $this->path;
   }

   public function getVideoThumbnailAttribute()
   {
        return '/storage/' . $this->thumbnail;
   }

   public function scopeFilter(Builder $builder, array $data)
   {
        return (new VideoFilter($builder))->apply($data);
   }
}
