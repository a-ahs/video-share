<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index()
    {
        $videos = Video::with(['user', 'category'])->latest()->take(6)->get();
        $mostViewed = Video::with(['user', 'category'])->get()->random(6);
        $mostPopular = Video::with(['user', 'category'])->get()->random(6);

        return view('index', compact('videos', 'mostViewed', 'mostPopular'));
    }
}