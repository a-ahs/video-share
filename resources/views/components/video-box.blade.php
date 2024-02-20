<div class="col-lg-2 col-md-4 col-sm-6">
    <div class="video-item">
        <div class="thumb">
            <div class="hover-efect"></div>
            <small class="time">{{ $video->length_in_human }}</small>
            <a href="{{ route('videos.show', $video->slug) }}"><img src="{{ $video->video_thumbnail }}" alt=""></a>
        </div>
        <div class="video-info">
            <a href="{{ route('videos.show', $video->slug) }}" class="title">{{ $video->name }}</a>
            @can('edit-video', $video)
                <a href="{{ route('videos.edit', $video->slug) }}">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            @endcan
            <a class="channel-name">{{ $video->owner_name }}<span>
                    <i class="fa fa-check-circle"></i></span></a>
            <span class="date"><i class="fa fa-clock-o"></i>{{ $video->created_at }}</span>
            <span class="date"><i class="fa fa-tag"></i>{{ $video->category_name }}</span>
        </div>
    </div>
</div>