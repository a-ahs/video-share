@extends('layout')

@section('content')

<h1 class="new-video-title"><i class="fa fa-bolt"></i>مرتبط با {{ $title }} </h1>
<div class="row">
    <!-- video-item -->
   @foreach ($videos as $video)
       <x-video-box :video="$video"></x-video-box>
  @endforeach
</div>
<div class="text-center" dir="ltr">
  {{ $videos->links() }}
</div>

@endsection