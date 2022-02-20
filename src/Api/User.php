<?php

namespace Plugrbase\TwitterApi\Api;

class User extends ApiEntity
{
    /**
     * Get user.
     *
     * @return object
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $id, array $parameters = [])
    {
        return json_decode(
            $this->twitterApi->get('users/' . $id, ['query' => $parameters])
                ->getBody()
                ->getContents()
        );
    }

    /**
     * Get many users.
     *
     * @return object
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMany(array $ids, array $parameters = [])
    {
        $parameters['ids'] = implode(',', $ids);
        
        return json_decode(
            $this->twitterApi->get('users', ['query' => $parameters])
                ->getBody()
                ->getContents()
        );
    }

    /**
     * Get user by username.
     *
     * @return object
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUsername(string $username, array $parameters = [])
    {
        return json_decode(
            $this->twitterApi->get('users/by/username/' . $username, ['query' => $parameters])
                ->getBody()
                ->getContents()
        );
    }

    /**
     * Get many users by username.
     *
     * @return object
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getManyByUsername(array $usernames, array $parameters = [])
    {
        $parameters['usernames'] = implode(',', $usernames);
        
        return json_decode(
            $this->twitterApi->get('users/by', ['query' => $parameters])
                ->getBody()
                ->getContents()
        );
    }

    /**
     * Get Followers of user ID.
     *
     * @return object
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFollowers(int $id, array $parameters = [])
    {
        return json_decode(
            $this->twitterApi->get('users/' . $id . '/followers', ['query' => $parameters])
                ->getBody()
                ->getContents()
        );
    }
}