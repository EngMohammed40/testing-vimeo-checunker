<?php

namespace App\Spiders;

use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;
use Spatie\Browsershot\Browsershot;

class LaravelDocsSpider extends BasicSpider
{
    public array $startUrls = [
        'https://shbabbek.com/natega/822054'
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        //
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 1;

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        try{
            $text = $response->filter('.contact-form p')->text();
            if($text == "لم تظهر النتيجة بعد برجاء العودة لاحقا"){

                dd('DONE');
            }
            yield $this->item([
                'text' => $text,
            ]);
        }catch(\Exception $e){
        }
    }
}
