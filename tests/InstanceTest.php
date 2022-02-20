<?php

namespace Plugrbase\TwitterApi\Tests;

use Plugrbase\TwitterApi\TwitterApi;

class InstanceTest extends TestCase
{
    public function test_twitter_api_should_be_instance_of_twitter_api()
    {
        $twitterApi = new TwitterApi(config('twitter-api.api_bearer_token'));
        $this->assertInstanceOf(TwitterApi::class, $twitterApi);
    }

    public function test_oauth_credentials_config_value_should_be_set()
    {
        $twitterApi = new TwitterApi(config('twitter-api.api_bearer_token'));
        $this->assertEquals(config('twitter-api.api_consumer_key'), $twitterApi->getOAuthCredentials()['consumer_key']);
        $this->assertEquals(config('twitter-api.api_consumer_key_secret'), $twitterApi->getOAuthCredentials()['consumer_secret']);
        $this->assertEquals(config('twitter-api.api_access_token'), $twitterApi->getOAuthCredentials()['token']);
        $this->assertEquals(config('twitter-api.api_token_secret'), $twitterApi->getOAuthCredentials()['token_secret']);
    }

    public function test_oauth_credentials_should_be_overwritten()
    {
        $oAuthCredentials = [
            'consumer_key' => 'toto-aa',
            'consumer_secret' => 'toto-bb',
            'token' => 'toto-cc',
            'token_secret' => 'toto-dd',
        ];

        $twitterApi = new TwitterApi(config('twitter-api.api_bearer_token'), $oAuthCredentials);

        $this->assertEquals('toto-aa', $twitterApi->getOAuthCredentials()['consumer_key']);
        $this->assertEquals('toto-bb', $twitterApi->getOAuthCredentials()['consumer_secret']);
        $this->assertEquals('toto-cc', $twitterApi->getOAuthCredentials()['token']);
        $this->assertEquals('toto-dd', $twitterApi->getOAuthCredentials()['token_secret']);
    }

    public function test_oauth_credentials_should_be_partialy_overwritten()
    {
        $oAuthCredentials = [
            'consumer_key' => 'toto-aa',
            'token' => 'toto-cc',
        ];

        $twitterApi = new TwitterApi(config('twitter-api.api_bearer_token'), $oAuthCredentials);
        
        $this->assertEquals('toto-aa', $twitterApi->getOAuthCredentials()['consumer_key']);
        $this->assertEquals(config('twitter-api.api_consumer_key_secret'), $twitterApi->getOAuthCredentials()['consumer_secret']);
        $this->assertEquals('toto-cc', $twitterApi->getOAuthCredentials()['token']);
        $this->assertEquals(config('twitter-api.api_token_secret'), $twitterApi->getOAuthCredentials()['token_secret']);
    }
}
