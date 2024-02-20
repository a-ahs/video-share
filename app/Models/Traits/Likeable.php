<?php

    namespace App\Models\Traits;

    use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

    trait likeable
    {
        public function likes()
        {
            return $this->morphMany(Like::class, 'likeable');
        }

        public function getLikesCountAttribute()
        {
            return Cache::remember($this->getLikeCacheKeyName(), 10, function(){
                return $this->likes()->where('vote', 1)->count();
            });
        }

        public function getDislikesCountAttribute()
        {
            return Cache::remember($this->getDislikeCacheKeyName(), 10, function(){
                return $this->likes()->where('vote', -1)->count();
            });
        }

        public function likeBy(User $user)
        {
            if($this->isLikedBy($user))
            {
                $this->likes()->where('vote', 1)->where('user_id', $user->id)->delete();
                return back();
            }
            if($this->disLikeExists($user))
            {
                return;
            }
            return $this->likes()->create([
                'user_id' => $user->id,
                'vote' => 1
            ]);
        }

        public function dislikeBy(User $user)
        {
            if($this->isDislikedBy($user))
            {
                $this->likes()->where('vote', -1)->where('user_id', $user->id)->delete();
                return back();
            }
            if($this->likeExists($user))
            {
                return;
            }
            return $this->likes()->create([
                'user_id' => $user->id,
                'vote' => -1
            ]);
        }

        public function isLikedBy(User $user)
        {
            return $this->likes()->where('vote', 1)
                    ->where('user_id', $user->id)
                    ->exists();
        }

        public function isDislikedBy(User $user)
        {
            return $this->likes()->where('vote', -1)
                    ->where('user_id', $user->id)
                    ->exists();
        }

        public function disLikeExists(User $user)
        {
            return $this->likes()->where('vote', -1)->where('user_id', $user->id)->exists();
        }
  
        public function likeExists(User $user)
        {
            return $this->likes()->where('vote', 1)->where('user_id', $user->id)->exists();
        }

        public function getLikeCacheKeyName()
        {
            return 'likes_count_for_' . class_basename($this) . '_' . $this->id;
        }

        public function getDislikeCacheKeyName()
        {
            return 'dislikes_count_for_' . class_basename($this) . '_' . $this->id;
        }
    }

?>