<?php

namespace Plugrbase\TwitterApi\Tests\Feature;

use Plugrbase\TwitterApi\Tests\TestCase;

class UserTest extends TestCase
{
    public function test_get_user_should_return_data()
    {
        $user = $this->twitterApi()->user()->get(36441453);

        $this->assertNotEmpty($user);
        $this->assertEquals(36441453, $user->data->id);
    }

    public function test_get_user_with_parameters_should_return_requested_data()
    {
        $user = $this->twitterApi()->user()->get(36441453, ['user.fields' => 'created_at']);

        $this->assertNotEmpty($user);
        $this->assertObjectHasAttribute('created_at', $user->data);
        $this->assertEquals(36441453, $user->data->id);
    }

    public function test_get_many_users_should_return_data()
    {
        $users = $this->twitterApi()->user()->getMany([36441453, 36441453]);

        $this->assertNotEmpty($users);
        $this->assertCount(2, $users->data);
    }

    public function test_get_many_users_with_parameters_should_return_requested_data()
    {
        $users = $this->twitterApi()->user()->getMany([36441453, 36441453], ['user.fields' => 'created_at']);
        $this->assertNotEmpty($users);
        $this->assertObjectHasAttribute('created_at', $users->data[0]);
        $this->assertObjectHasAttribute('created_at', $users->data[1]);
        $this->assertCount(2, $users->data);
    }

    public function test_get_user_by_username_should_return_data()
    {
        $user = $this->twitterApi()->user()->getByUsername('Hey_djoul');

        $this->assertNotEmpty($user);
        $this->assertEquals(36441453, $user->data->id);
    }

    public function test_get_many_users_by_username_should_return_data()
    {
        $users = $this->twitterApi()->user()->getManyByUsername(['Hey_djoul', 'Hey_djoul']);

        $this->assertNotEmpty($users);
        $this->assertCount(2, $users->data);
    }

    public function test_get_followers_should_return_data()
    {
        $followers = $this->twitterApi()->user()->getFollowers(36441453, ['max_results' => 5]);

        $this->assertNotEmpty($followers);
        $this->assertCount(5, $followers->data);
    }
}
