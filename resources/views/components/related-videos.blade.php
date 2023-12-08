<div class="col-md-4">
    @foreach ($videos as $video)
        <div id="related-posts">
            <!-- video item -->
            <div class="related-video-item">
                <div class="thumb">
                    <small class="time">10:53</small>
                    <a href="{{ route('videos.show', $video->slug) }}"><img src="{{ $video->thumbnail }}" alt=""></a>
                </div>
                <a href="{{ route('videos.show', $video->slug) }}" class="title">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ </a>
                <a class="channel-name" href="#">داود طاهری<span>
                    <i class="fa fa-check-circle"></i></span>
                </a>
            </div>
            
        </div>
    @endforeach
</div>