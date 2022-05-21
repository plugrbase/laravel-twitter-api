<?php

namespace Plugrbase\TwitterApi;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Plugrbase\TwitterApi\Api\Tweet;
use Plugrbase\TwitterApi\Api\User;

class TwitterApi
{
    use Request;

    /**
     * The bearer token.
     */
    private string $bearerToken;

    /**
     * The oauth credentials.
     */
    private array $oAuthCredentials;

    /**
     * The client.
     */
    private GuzzleClient $guzzle;

    /**
     * Create a new TwitterApi instance.
     *
     * @return void
     */
    public function __construct(string $bearerToken = null, $oAuthCredentials = [])
    {
        if (! is_null($bearerToken)) {
            $this->bearerToken = $bearerToken;
        }
        
        if (is_null($bearerToken) && config()->has('twitter-api.api_bearer_token')) {
            $this->bearerToken = config('twitter-api.api_bearer_token');
        }

        if (config()->has('twitter-api.api_consumer_key') && config('twitter-api.api_consumer_key') != '') {
            $this->oAuthCredentials['consumer_key'] = config('twitter-api.api_consumer_key');
        }

        if (config()->has('twitter-api.api_consumer_key_secret') && config('twitter-api.api_consumer_key_secret') != '') {
            $this->oAuthCredentials['consumer_secret'] = config('twitter-api.api_consumer_key_secret');
        }

        if (config()->has('twitter-api.api_access_token') && config('twitter-api.api_access_token') != '') {
            $this->oAuthCredentials['token'] = config('twitter-api.api_access_token');
        }

        if (config()->has('twitter-api.api_token_secret') && config('twitter-api.api_token_secret') != '') {
            $this->oAuthCredentials['token_secret'] = config('twitter-api.api_token_secret');
        }

        if (count($oAuthCredentials)) {
            foreach ($oAuthCredentials as $key => $value) {
                $this->oAuthCredentials[$key] = $value;
            }
        }

        if (config()->has('twitter-api.api_url')) {
            $this->setClient(config('twitter-api.api_url'), $this->bearerToken, $this->oAuthCredentials);
        }
    }

    /**
     * Create the HTTP client.
     *
     * @return object
     */
    public function setClient(string $uri, $bearerToken, $oAuthCredentials = [])
    {
        $config = ['base_uri' => $uri];

        if ($bearerToken != null) {
            $config['headers'] = ['Authorization' => 'Bearer ' . $bearerToken];
        }

        if (count($oAuthCredentials)) {
            $stack = HandlerStack::create();

            $middleware = new Oauth1($oAuthCredentials);

            $stack->push($middleware);

            $config['handler'] = $stack;
            $config['auth'] = 'oauth';
        }

        $this->guzzle = new GuzzleClient($config);

        return $this;
    }

    /**
     * Get credentials.
     *
     * @return object
     */
    public function getOAuthCredentials()
    {
        return $this->oAuthCredentials;
    }

    /**
     * Return the tweet object.
     *
     * @return \Plugrbase\TwitterApi\Api\Tweet
     */
    public function tweet()
    {
        return new Tweet($this);
    }

    /**
     * Return the user object.
     *
     * @return \Plugrbase\TwitterApi\Api\User
     */
    public function user()
    {
        return new user($this);
    }
}
