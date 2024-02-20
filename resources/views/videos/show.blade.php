@extends('layout')

@section('content')

<div id="all-output" class="col-md-12">
    <div class="row">
        <!-- Watch -->
        <div class="col-md-8">
            <div id="watch">

                <!-- Video Player -->
                <h1 class="video-title">{{ $video->name }}</h1>
                <div class="video-code">
                    <video style="height: 100%; width: 100%;" controls>
                        <source src="{{ $video->video_path }}" type="video/mp4">
                    </video>
                </div><!-- // video-code -->

                <div class="video-share">
                    @auth
                        <ul class="like">
                            <li><a class="deslike"
                                href="{{ route('dislikes.store', ['likeable_type' => 'video', 'likeable_id' => $video]) }}">{{ $video->dislikes_count }}<i class="fa fa-thumbs-down"></i></a></li>
                            <li><a class="like" 
                                href="{{ route('likes.store', ['likeable_type' => 'video', 'likeable_id' => $video]) }}">{{ $video->likes_count }}<i class="fa fa-thumbs-up"></i></a></li>
                        </ul>
                    @endauth
                    @guest
                        <div>برای لایک و دیس‌لایک لطفا وارد شوید  </div>
                    @endguest
                    
                </div><!-- // video-share -->
                <!-- // Video Player -->


                <!-- Chanels Item -->
                <div class="chanel-item">
                    <div class="chanel-thumb">
                        <a href="#"><img src="{{ $video->owner_avatar }}" alt=""></a>
                    </div>
                    <div class="chanel-info">
                        <a class="title" href="#">{{ $video->owner_name }}</a>
                        <span class="subscribers">436,414 اشتراک</span>
                    </div>
                    <a href="" class="subscribe">اشتراک</a>
                </div>
                <!-- // Chanels Item -->


                <!-- Comments -->
                <div id="comments" class="post-comments">
                    <h3 class="post-box-title"><span>{{ $video->Comments->count() }}</span> نظرات</h3>
                    <ul class="comments-list">
                        @foreach ($video->Comments as $comment)
                            <li>
                                <div class="post_author">
                                    <div class="img_in">
                                        <a href="#"><img src="{{ $comment->User->gravatar }}" alt=""></a>
                                    </div>
                                    <a href="#" class="author-name">{{ $comment->User->name }}</a>
                                    <time datetime="2017-03-24T18:18">{{ $comment->created_at }}</time>
                                    <a class='deslike mr-5' style="color: #aaaaaa"
                                        href="{{ route('dislikes.store', ['likeable_type' => 'comment', 'likeable_id' => $comment]) }}">{{ $comment->dislikes_count }}<i class="fa fa-thumbs-down"></i></a>
                                    <a class='like mr-5' style="color: #66c0c2"
                                        href="{{ route('likes.store', ['likeable_type' => 'comment', 'likeable_id' => $comment]) }}">{{ $comment->likes_count }}<i
                                            class="fa fa-thumbs-up"></i></a>

                                </div>
                                <p>{{ $comment->body }}</p>                             
                            </li>
                            
                        @endforeach
                    </ul>

                    @auth
                        {{-- @can('create', $video) --}}
                            <h3 class="post-box-title">ارسال نظرات</h3>
                            <form action="{{ route('comments.store', $video) }}" method="POST">
                                @csrf
                                <textarea class="form-control" name="body" rows="8" id="Message" placeholder="پیام"></textarea>
                                <button id="contact_submit" class="btn btn-dm">ارسال پیام</button>
                            </form>
                        {{-- @endcan     --}}
                    @endauth
                    
                </div>
                <!-- // Comments -->


            </div><!-- // watch -->
        </div>

        <x-related-videos :video="$video"></x-related-videos>

    </div><!-- // row -->
</div>

@endsection