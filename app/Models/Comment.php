<?php

namespace App\Models;

use App\Models\Traits\likeable;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, likeable;

    protected $fillable = ['user_id', 'body'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Video()
    {
        return $this->belongsTo(Video::class);
    }

    public function getCreatedAtAttribute()
    {
        return (new Verta($this->attributes['created_at']))->formatDifference(verta());
         
    }
}
