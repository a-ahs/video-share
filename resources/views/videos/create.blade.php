@extends('layout')

@section('content')

<div id="main-category">
  
  <div class="site-output">
    <div class="col-md-2 no-padding-left hidden-sm hidden-xs">
        <div class="left-sidebar">
            <div id="sidebar-stick" >
            <ul class="menu-sidebar">
                <li><a href="01-home.html"><i class="fa fa-home"></i>خانه</a></li>
                <li><a href="#"><i class="fa fa-bolt"></i>رندوم</a></li>
                <li><a href="14-history.html"><i class="fa fa-clock-o"></i>تاریخچه</a></li>
                <li><a href="11-blog.html"><i class="fa fa-file-text"></i>وبلاگ</a></li>
                <li><a href="10-upload.html"><i class="fa fa-upload"></i>آپلود</a></li>
            </ul>
            <ul class="menu-sidebar">
                <li><a href="#"><i class="fa fa-edit"></i>ویرایش پروفایل</a></li>
                <li><a href="#"><i class="fa fa-sign-out"></i>خروج</a></li>
            </ul>
            <ul class="menu-sidebar">
                <li><a href="#"><i class="fa fa-gear"></i>تنظیمات</a></li>
                <li><a href="#"><i class="fa fa-question-circle"></i>راهنما</a></li>
                <li><a href="#"><i class="fa fa-send-o"></i>ارسال بازخورد</a></li>
            </ul>
            </div><!-- // sidebar-stick -->
            <div class="clear"></div>
        </div><!-- // left-sidebar -->
  </div><!-- // col-md-2 -->



    <div id="all-output" class="col-md-10 upload">
        <x-validations-errors></x-validation-errors>
        <div id="upload">
            <div class="row">
                <!-- upload -->
                <div class="col-md-8">
                    <h1 class="page-title"><span>آپلود</span> فیلم</h1>
                    <form action="{{ route('videos.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('videos.name')</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="@lang('videos.name')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('videos.length')</label>
                                <input type="text" name="length" class="form-control" value="{{ old('length') }}" placeholder="@lang('videos.length')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('videos.slug')</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="@lang('videos.slug')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('videos.url')</label>
                                <input id="upload_file" name="url" type="text" class="form-control" value="{{ old('url') }}" placeholder="@lang('videos.url')">
                            </div>
                            <div class="col-md-6">
                                <label>دسته بندی</label>
                                <select name="category_id" id="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>@lang('videos.descriptions')</label>
                                <textarea class="form-control" name="descriptions" rows="4" value="{{ old('descriptions') }}" placeholder="@lang('videos.descriptions')"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>@lang('videos.thumbnail')</label>
                                <input id="featured_image" name="thumbnail" type="text" class="form-control" value="{{ old('thumbnail') }}" placeholder="@lang('videos.thumbnail')">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" id="contact_submit" class="btn btn-dm">ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div><!-- // col-md-8 -->

                <div class="col-md-4">
                    <a href="#"><img src="{{ asset('demo_img/upload-adv.png') }}" alt=""></a>
                </div><!-- // col-md-8 -->
                <!-- // upload -->
            </div><!-- // row -->
        </div><!-- // upload -->
    </div>
  </div>

@endsection