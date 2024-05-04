<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // 基础http请求
        $response = $this->get('http://www.lrw.test/');
        // json
//        $response = $this->withHeaders([
//            'User-Access-Agent' => 'lrwapp/android',
//            'Authorization' => 'Bearer tokenxxx'
//        ])->json('GET', 'http://www.lrw.com/');

//        $response->dumpHeaders();

//        $response->dumpSession();

//        $response->dump();

        $response->assertStatus(200);

//        $response = $this
//            ->getJson('http://www.lrw.com/', [
//                'User-Access-Agent' => 'lrwapp/android',
//                'Authorization' => 'Bearer tokenxxx'
//            ]);


//        $response->dump();
//        $response
//            ->assertStatus(200);
//            ->assertJson([
//                'code' => 0,
//            ]);

    }


    /**
     * 测试命令行
     *
     * @return void
     */
//    public function testConsoleCommand()
//    {
//        $this->artisan('question')
//            ->expectsQuestion('What is your name?', 'Taylor Otwell')
//            ->expectsQuestion('Which language do you program in?', 'PHP')
//            ->expectsOutput('Your name is Taylor Otwell and you program in PHP.')
//            ->assertExitCode(0);
//    }

}
