<?php

    namespace App\Services;

    use FFMpeg\FFMpeg;
    use Illuminate\Support\Facades\Storage;

    class FFmpegAdapter
    {
        public $ffprobe;
        public $video_probe;
        public $ffmpeg;
        public $video;

        public function __construct(public string $path)
        {
            $this->ffprobe = \FFMpeg\FFProbe::create();
            $this->ffmpeg = \FFMpeg\FFMpeg::create();

            $this->video_probe = $this->ffprobe->format(Storage::path($path));
            $this->video = $this->ffmpeg->open(Storage::path($path));
        }

        public function getDuration()
        {
            return $this->video_probe->get('duration');
        }

        public function getFrame()
        {
            $frame = $this->video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(2));
            $fileName = pathinfo($this->path, PATHINFO_FILENAME) . '.jpg';
            $storage_path = storage_path('app/public/' . $fileName);
            $frame->save($storage_path);
            return $fileName;
        }
    }

?>