<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testApiGetReturnsAsExpected()
    {
        $response = $this->get('api/get/1');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($response->content(), '1');
    }
    public function testApiTruncateReturnsAsExpected()
    {
        $response = $this->delete('api/truncate');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($response->content(), '1');
    }
}
