<?php

namespace App\Providers;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\TwitterClient;
use Illuminate\Support\ServiceProvider;

class TwitterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TwitterOAuth::class, function (): TwitterOAuth {
            return new TwitterOAuth(
                (string) config('services.twitter.consumer_key'),
                (string) config('services.twitter.consumer_secret'),
                (string) config('services.twitter.access_token'),
                (string) config('services.twitter.access_token_secret')
            );
        });

        $this->app->bind('twitter', function () {
            return app(TwitterClient::class);
        });
    }

    public function boot()
    {
    }
}
