<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CardGeneratorTest extends TestCase
{
//    use RefreshDatabase;
//
//    public function setUp(): void
//    {
//        parent::setUp();
//        $this->refreshDatabase();
//    }

    /**
     * A basic test example.
     */
    public function test_generate_card_true(): void
    {
//        $this->assertTrue(true);
//        $response = $this->get('api/generate_card/123456');
//        dd($response->getContent());

        $responses = Http::pool(fn (Pool $pool) => [
            $pool->get('http://localhost:9000/api/generate_card/123456'),
        ]);
        dd($responses);

        $this->assertEquals(200, $response->status());
    }
}
