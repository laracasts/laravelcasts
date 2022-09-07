<?php

namespace App;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterClient
{
    public function __construct(protected TwitterOAuth $twitter)
    {
    }

    public function tweet(string $status): array
    {
        return (array) $this->twitter->post('statuses/update', compact('status'));
    }
}
