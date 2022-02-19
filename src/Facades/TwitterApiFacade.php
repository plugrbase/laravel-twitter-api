<?php

namespace Plugrbase\Facades\TwitterApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Plugrbase\TwitterApi\Skeleton\SkeletonClass
 */
class TwitterApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'twitter-api';
    }
}
