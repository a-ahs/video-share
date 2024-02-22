<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Video;
use App\Services\FFmpegAdapter;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Video::class, 'video');
    }

    public function create()
    {
        $categories = Category::all();
        return view('videos.create', compact('categories'));
    }

    public function store(StoreVideoRequest $request)
    {
        (new VideoService)->create($request->user(), $request->all());
        event(new VideoCreated($request->user()));

        return redirect()->route('index')->with('success', 'عملیات موفقیت آمیز بود');
    }

    public function show(Request $request, Video $video)
    {
        $video->load('comments.user');
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {                
        $categories = Category::all();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        (new VideoService)->update($video, $request->all());
        return redirect()->route('videos.show', $video->slug)->with('success', 'آپدیت موفقیت آمیز بود');
    }
}
