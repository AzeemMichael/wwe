<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoControllerTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStoreVideoTest()
    {
//        $_FILES = [
//            'video'    =>  [
//                'name'      =>  'dotcom_nxt392_tomnight_512x288.mp4',
//                'tmp_name'  =>  __DIR__ . '/_files/dotcom_nxt392_tomnight_512x288.mp4',
//                'type'      =>  'video/x-m4v',
//                'size'      =>  1912914,
//                'error'     =>  0
//            ]
//        ];
//
//        $data = [
//            'title' => str_random(20),
//            'video' => $_FILES['video']
//        ];

        $files = Storage::files(__DIR__.'/_files');

        dd($files);

        $count = Video::count();

        $this->post("/videos", array_filter($data, function ($value) {
                return $value !== null;
            }));

        $this->assertTrue(Video::count() > $count);
    }
}
