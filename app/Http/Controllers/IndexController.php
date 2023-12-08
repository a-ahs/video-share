<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->take(6)->get();
        $mostViewed = Video::all()->random(6);
        $mostPopular = Video::all()->random(6);

        return view('index', compact('videos', 'mostViewed', 'mostPopular'));
    }
}
