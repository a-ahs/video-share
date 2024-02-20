<?php

use App\Http\Controllers\CategoryVideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\VideoController;
use App\Jobs\Otp;
use App\Jobs\VideoShare;
use App\Models\User;
use App\Models\Video;
use App\Notifications\VideoProccess;
use App\Services\FFmpegAdapter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/videos/upload', [VideoController::class, 'create'])->middleware('verifyemail')->name('videos.create');
Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
Route::put('/videos/{video}', [VideoController::class, 'update'])->name('videos.update');
Route::get('/categories/{category:slug}/videos', [CategoryVideoController::class, 'index'])->name('category.videos.index');
Route::post('/videos/{video}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('{likeable_type}/{likeable_id}/like', [LikeController::class, 'store'])->name('likes.store');
Route::get('{likeable_type}/{likeable_id}/dislike', [DislikeController::class, 'store'])->name('dislikes.store');
Route::get('redirect/{provider}', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('jobs', function () {
    Otp::dispatch();
    VideoShare::dispatch();
});

Route::get('signedurl', function () {
    echo 'verify';
})->name('sign.verify');

Route::get('generate', function (){
    echo URL::signedRoute('sign.verify', ['user' => 1]);
});
Route::get('generate2', function (){
    echo URL::temporarySignedRoute('sign.verify', now()->addMinutes(10) , ['user' => 1]);
});

Route::get('notify', function(){
    $user = User::first();
    $video = Video::first();
    $user->notify(new VideoProccess($video));
});

// Route::get('file', function(){
//     $content = Storage::get('contracts/a.png');
//     return Response::make($content)->header('content-type', 'image/png');
// });

// Route::get('file2', function(){
//     return response()->file(storage_path('app/contracts/a.png'));
// });

// Route::get('file3', function(){
//     return Storage::download('contracts/a.png');
// });

Route::get('ffmpeg', function(){
    $path = 'dUTuLqBNPbtlg6ZWdWLWQIcodzV2CrnfZ6LHCZzR.mp4';
    $service = new FFmpegAdapter($path);
    dd($service->getDuration());
});

// Route::get('test-gate', function(){
//     $result = Gate::allows('test');
//     dd($result);
// });

Route::get('cache', function(){
    $value = Cache::remember('video_count', 10, function(){
        sleep(3);
        return Video::all()->count();
    });

    dd($value);
});
