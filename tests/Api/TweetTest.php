<?php

namespace Plugrbase\TwitterApi\Tests\Feature;

use Plugrbase\TwitterApi\Tests\TestCase;

class TweetTest extends TestCase
{
    public function test_get_tweet_should_return_data()
    {
        $tweet = $this->twitterApi()->tweet()->get(1489639954397474829);

        $this->assertNotEmpty($tweet);
        $this->assertEquals(1489639954397474829, $tweet->data->id);
    }

    public function test_get_many_tweets_should_return_data()
    {
        $tweets = $this->twitterApi()->tweet()->getMany([1489639954397474829, 1493343013397016576]);

        $this->assertNotEmpty($tweets);
        $this->assertCount(2, $tweets->data);
    }

    public function test_get_tweet_with_place_fields_should_return_data()
    {
        $tweet = $this->twitterApi()->tweet()->get(1489639954397474829, ['expansions' => 'referenced_tweets.id.author_id', 'place.fields' => 'contained_within,country']);

        $this->assertNotEmpty($tweet);
        $this->assertEquals(1489639954397474829, $tweet->data->id);
    }
}
