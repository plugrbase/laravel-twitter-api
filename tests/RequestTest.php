<?php

namespace Plugrbase\TwitterApi\Tests;

use Plugrbase\TwitterApi\Exceptions\AuthorizationException;
use Plugrbase\TwitterApi\Exceptions\NotFoundException;

class RequestTest extends TestCase
{
    public function test_request_should_return_not_found_message()
    {
        try {
            $this->twitterApi()->get('toto');
        } catch (NotFoundException $e) {
            $this->assertSame($e->getMessage(), (new NotFoundException)->getMessage());
        }
    }

    public function test_request_should_return_unauthorized()
    {
        try {
            $this->twitterApi('toto', ['token' => 'toto'])->get('tweets/1')->getBody()->getContents();
        } catch (AuthorizationException $e) {
            $this->assertSame($e->getMessage(), (new AuthorizationException)->getMessage());
        }
    }
}
