<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\FilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemOperator;

class VimeoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FilesystemOperator::class, function ($app) {
            $config = $app['config']['filesystems.disks.vimeo'];
            $adapter = new VimeoAdapter($config['token']);
            $filesystem = new Filesystem($adapter);
            return new FilesystemAdapter($filesystem);
        });
    }

    public function boot()
    {
        //
    }
}
