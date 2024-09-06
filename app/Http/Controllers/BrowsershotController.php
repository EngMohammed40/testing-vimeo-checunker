<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
class BrowsershotController extends Controller
{
    public function screenshot() {
        Browsershot::url('https://shbabbek.com/natega/822054')
        ->setOption('landscape', true)
        ->windowSize(3840, 2160)
        ->waitUntilNetworkIdle()
        ->save("public/" . 'natega.jpg');
    }
}
