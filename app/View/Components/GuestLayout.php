<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GuestLayout extends Component
{
    public function __construct(public string $pageTitle = 'LaravelCasts')
    {
    }

    public function render(): View
    {
        return view('layouts.guest');
    }
}
