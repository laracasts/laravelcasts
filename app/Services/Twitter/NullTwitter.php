<?php

namespace App\Services\Twitter;

class NullTwitter implements TwitterClientInterface
{
    public function tweet(string $status): array
    {
        return [];
    }
}
