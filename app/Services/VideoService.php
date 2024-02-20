<?php

    namespace App\Services;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

    class VideoService
    {
        public function create(User $user, array $data)
        {
            $data = $this->saveFile($data);
            return $user->videos()->create($data);
        }

        public function update(Video $video, array $data)
        {
            if(isset($data['file']) && $data['file'] instanceof File)
            {
                $data = $this->saveFile($data);
            }
            
            return $video->update($data);
        }

        private function saveFile(array $data)
        {
            $path = Storage::putFile('', $data['file']);
            $ffmpegService = new FFmpegAdapter($path);
            $data['path'] = $path;
            $data['length'] = $ffmpegService->getDuration();
            $data['thumbnail'] = $ffmpegService->getFrame();
            return $data;    
        }
    }

?>