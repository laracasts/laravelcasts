<?php

use App\Services\Twitter\NullTwitterClient;

it('returns empty array for tweet call', function () {
    expect(new NullTwitterClient())
        ->tweet('Our tweet')
        ->toBeEmpty();
});
