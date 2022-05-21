# A small Laravel wrapper for the Twitter API V2.

A very small package providing some functions to access the Twitter V2 API.

## Installation

You can install the package via composer:

```bash
composer require plugrbase/laravel-twitter-api
```

Optionally publish the config file of this package:

```bash
php artisan vendor:publish --provider="Plugrbase\TwitterApi\TwitterApiServiceProvider"
```

Add the following environment variables.

```
TWITTER_API_CONSUMER_KEY=
TWITTER_API_CONSUMER_KEY_SECRET=
TWITTER_BEARER_TOKEN=
TWITTER_ACCESS_TOKEN=
TWITTER_TOKEN_SECRET=
TWITTER_API_URL=
```

## Functions

### Twitter API v2

* `$twitterApi = new TwitterApi($bearerToken, $oAuthCredentials);` - Create a new instance. If the oauth credentials are not passed, then the application config variables we'll be used instead (if provided).

#### Tweet

* `$twitterApi->tweet()->get($tweetId)` - Return a single Tweet.
* `$twitterApi->tweet()->get($tweetId, ['expansions' => 'referenced_tweets.id.author_id','place.fields' => 'contained_within,country']);` - Return a single Tweet with optional query parameters.
* `$twitterApi->tweet()->getMany([$tweetId1, $tweetId2])` - Return multiple Tweets.
* `$twitterApi->tweet()->create($params)` - Create a Tweet. ex $params = ["text": "Hello World!"];

#### User

* `$twitterApi->user()->get($userId)` - Return a single user.
* `$twitterApi->user()->get($userId, , ['user.fields' => 'created_at']);` - Return a single user with optional query parameters.
* `$twitterApi->user()->getMany([$userId1, $userId2])` - Return multiple users.
* `$twitterApi->user()->getByUsername($username)` - Return a single user by username.
* `$twitterApi->user()->getManyByUsername([$username1, $username2])` - Return multiple users by username.
* `$twitterApi->user()->getFollowers($userId)` - Return all the followders of a user.
* `$twitterApi->user()->getFollowers($userId, ['max_results' => 5])` - Return the five earliest followers  of a user.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
