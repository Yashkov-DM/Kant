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

    public function test_generate_card_true(): void
    {
        $responses = Http::pool(function (Pool $pool) {
            for ($i = 0; $i < 20; $i++) {
                $pool->get('http://localhost:8876/api/generate_card/123456');
            }
        });

        $numberCardsList = [];
        $errors = [];
        $count = 0;
        foreach ($responses as $response) {
            $record = json_decode($response->body());
            $count++;
            if ($record) {
                $numberCardsList[] = $record->data->number_card;
            } else {
                $errors[] =  $record;
            }
        }
//        dd($numberCardsList, $errors);
        $numberCardsList = array_unique($numberCardsList);
        $this->assertEquals($count, count($numberCardsList));
    }
}
