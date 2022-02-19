<?php

namespace Plugrbase\TwitterApi\Tests;

use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase as Orchestra;
use Plugrbase\TwitterApi\TwitterApi;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        // Load env files
        (Dotenv::createImmutable(__DIR__.'/..', '.env'))->safeLoad();

        parent::setUp();

        $this->app['config']->set('twitter-api.api_consumer_key', env('TWITTER_API_CONSUMER_KEY'));
        $this->app['config']->set('twitter-api.api_consumer_key_secret', env('TWITTER_API_CONSUMER_KEY_SECRET'));
        $this->app['config']->set('twitter-api.api_bearer_token', env('TWITTER_BEARER_TOKEN'));
        $this->app['config']->set('twitter-api.api_url', env('TWITTER_API_URL'));

        $this->app['config']->set('twitter-api.api_access_token', env('TWITTER_ACCESS_TOKEN'));
        $this->app['config']->set('twitter-api.api_token_secret', env('TWITTER_TOKEN_SECRET'));
    }

    protected function twitterApi($bearerToken = null, $oAuthCredentials = [])
    {
        if (count($oAuthCredentials) == 0) {
            $oAuthCredentials = [
                'consumer_key'    => config('twitter-api.api_consumer_key'),
                'consumer_secret' => config('twitter-api.api_consumer_key_secret'),
                'token'           => config('twitter-api.api_access_token'),
                'token_secret'    => config('twitter-api.api_token_secret'),
            ];
        }

        return new TwitterApi($bearerToken, $oAuthCredentials);
    }
}
