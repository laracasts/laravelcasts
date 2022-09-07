<?php

namespace Tests\Feature\Fakes;

use PHPUnit\Framework\Assert;

class TwitterFake
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
