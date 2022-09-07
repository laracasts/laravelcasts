<?php

namespace Tests\Feature\Fakes;

use App\Services\Twitter\TwitterClientInterface;
use PHPUnit\Framework\Assert;

class TwitterFake implements TwitterClientInterface
{
    protected array $tweets = [];

    public function tweet(string $status): array
    {
        $this->tweets[] = $status;

        return [
            'status' => $status,
        ];
    }

    public function assertTweetSent(string $status): self
    {
        Assert::assertContains($status, $this->tweets);

        return $this;
    }
}
