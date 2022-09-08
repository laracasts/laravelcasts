<?php

namespace App\Services\Twitter;

class NullTwitterClient implements TwitterClientInterface
{
    public function tweet(string $status): array
    {
        return [];
    }
}
