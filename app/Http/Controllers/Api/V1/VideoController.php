<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\VideoCreated;
use App\Events\VideoEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\User;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        return new VideoResource($video);
        // return $video;
    }

    public function index(Request $request)
    {
        $videos = Video::filter($request->all())->paginate();

        return VideoResource::collection($videos);
    }

    public function store(StoreVideoRequest $request)
    {

        (new VideoService)->create(auth()->user(), $request->all());

        return response()->json([
            'message' => 'Video Created',
        ], 201);
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $this->authorize('update', $video);

        (new VideoService)->update($video, $request->all());

        return response()->json([
            'message' => 'Video updated',
        ], 204);
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return response()->json([
            'message' => 'Video Deleted',
        ], 200);
    }
}
