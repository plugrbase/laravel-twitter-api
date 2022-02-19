<?php

namespace Plugrbase\TwitterApi\Api;

class Tweet extends ApiEntity
{
    /**
     * Get tweet.
     *
     * @return object
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $id, array $parameters = [])
    {
        return json_decode(
            $this->twitterApi->get('tweets/' . $id, ['query' => $parameters])
                ->getBody()
                ->getContents()
        );
    }

    /**
     * Get many tweet.
     *
     * @return object
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMany(array $ids, array $parameters = [])
    {
        $parameters['ids'] = implode(',', $ids);
        
        return json_decode(
            $this->twitterApi->get('tweets', ['query' => $parameters])
                ->getBody()
                ->getContents()
        );
    }

    /**
     * Create a tweet.
     *
     * @return object
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $params)
    {
        $data = [
            'headers' => ['content-type' => 'application/json'],
            'body' => json_encode($params)
        ];

        return json_decode(
            $this->twitterApi->post('tweets', $data)
                ->getBody()
                ->getContents()
        );
    }
}
