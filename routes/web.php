<?php

use App\Http\Controllers\BrowsershotController;
use App\Jobs\UploadVideoToVimeoJob;
use App\Models\Video;
use App\Spiders\LaravelDocsSpider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Pion\Laravel\ChunkUpload\Handler\ResumableJSUploadHandler;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use RoachPHP\Roach;
use Vimeo\Laravel\Facades\Vimeo;

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('save-video',function(Request $request){

    $reciever = new FileReceiver($request->file,$request,ResumableJSUploadHandler::class);

    $save = $reciever->receive();

    if($save->isFinished()){
        ini_set('max_execution_time', 3000000);
        $file = $save->getFile();
        $newFileName = $file->hashName();
        $file->move(public_path('videos'),$newFileName);
        dispatch(new UploadVideoToVimeoJob(public_path('videos').'/'.$newFileName));
    }

    $handler = $save->handler();
    return response()->json([
        'progress' => $handler->getPercentageDone(),
    ]);
});

Route::get('/video/{id}', function () {
    $video = Video::find(1);
    return view('video',[
        'video' => $video
    ]);
});
