<?php

namespace Plugrbase\TwitterApi\Api;

class ApiEntity
{
    /**
     * The twitterApi object.
     */
    public object $twitterApi;

    /**
     * Create a new object instance.
     *
     * @return void
     */
    public function __construct(object $twitterApi)
    {
        $this->twitterApi = $twitterApi;
    }
}
