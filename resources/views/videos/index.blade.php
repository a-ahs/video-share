@extends('layout')

@section('content')

<form class="mt-5" action="" method="GET">

  <div class="row">
    <div class="from-group col-md-3">
      <label for="inputCity">ترتیب بر اساس</label>
      
      <select class="form-control" id="inputCity" name="sortBy">
        <option value="created_at" {{ request()->query('sortBy') == 'created_at' ? 'selected' : '' }}>جدیدترین</option>
        <option value="like" {{ request()->query('sortBy') == 'like' ? 'selected' : '' }}>محبوبترین</option>
        <option value="length" {{ request()->query('sortBy') == 'length' ? 'selected' : '' }}>مدت زمان ویدیو</option>
      </select>
    </div>

    <div class="from-group col-md-3">
      <label for="inputState">مدت زمان</label>

      <select class="form-control" id="inputState" name="length">
        <option value="" {{ request()->query('length') == null ? 'selected' : '' }}>همه</option>
        <option value="1" {{ request()->query('length') == 1 ? 'selected' : '' }}>کمتر از 1 دقیقه</option>
        <option value="2" {{ request()->query('length') == 2 ? 'selected' : '' }}>1 تا 5 دقیقه</option>
        <option value="3" {{ request()->query('length') == 3 ? 'selected' : '' }}>بیشتر از 5 دقیقه</option>
      </select>
    </div>
    <input type="hidden" value="{{ request()->query('q') }}" name="q">
    <div class="form-group col-md-3" style="margin-top: 29px">
      <button type="submit" class="btn btn-primary">فیلتر</button>
    </div>
  </div>

</form>

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