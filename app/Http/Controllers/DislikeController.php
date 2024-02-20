<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DislikeController extends Controller
{
    public function store(Request $request, string $likeable_type, $likeable_id)
    {
        $likeable_id->dislikeBy(auth()->user());
        return back();
    }
}
