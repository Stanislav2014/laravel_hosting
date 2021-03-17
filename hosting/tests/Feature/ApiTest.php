<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A test fibonacci route.
     *
     * @return void
     */
    public function test_fibonacci()
    {
        $response = $this->call('POST', route('fibonacci'));
        $this->assertEquals(400, $response->status());

        $response = $this->call('POST', route('fibonacci'), ['number' => 3]);
        $decoded = json_decode($response->content(), true);
        $this->assertEquals(2, $decoded['result']);
    }

    /**
     * A test dns route.
     *
     * @return void
     */
    public function test_dns()
    {
        $response = $this->call('POST', route('dns'));
        $this->assertEquals(400, $response->status());

        $response = $this->call('POST', route('dns'), ['domain' => 'ya.ru', 'type' => 1]);
        $decoded = json_decode($response->content(), true);
        $this->assertEquals('ya.ru.', $decoded['result']['Answer'][0]['name']);
        $this->assertEquals(1, $decoded['result']['Answer'][0]['type']);
    }
}
