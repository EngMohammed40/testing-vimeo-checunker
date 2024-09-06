<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Vimeo\Laravel\Facades\Vimeo;

class UploadVideoToVimeoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $filePath)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $video = Video::create([
            'name' => $this->filePath,
            'job_id' => $this->job->getJobId(),
            'started_at' => now()
        ]);
        $link = Vimeo::upload($this->filePath, [
            'name' =>  'Football',
            'description' => 'Brazil is the best country to learn about football',
        ]);
        $video->update([
            'url' => $link,
            'finished_at' => now()
        ]);
    }
}
