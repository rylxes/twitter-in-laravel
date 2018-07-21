<?php

namespace Rylxes\Twitter\Test;

use Illuminate\Http\Response;
use Mockery;
use Orchestra\Testbench\TestCase;
use Illuminate\Foundation\Testing\TestResponse;
class TwitterTest extends TestCase
{
    /** @var Mockery\Mock */
    protected $twitter;

    public function setUp()
    {
        parent::setUp();
        $this->twitter = Mockery::mock(Twitter::class);
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

    protected function getTwitterExpecting($endpoint, array $queryParams, $response)
    {

        $this->twitter
            ->shouldReceive($endpoint)
            ->once()
            ->with(
                $queryParams
            )
            ->andReturn($response)
        ;


    }

    /** @test */
    public function successGetUsersWithScreenName()
    {
        $response = new Response(200);
        $this->getTwitterExpecting('getUsersLookup', ['screen_name' => 'my_screen_name'], $response);
        $channel_response = $this->twitter->getUsersLookup(['screen_name' => 'my_screen_name']);
        $this->assertInstanceOf(Response::class, $channel_response);

    }

}