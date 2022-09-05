<?php

namespace App\Http\Controllers;

class PageDashboardController extends Controller
{
    public function __invoke()
    {
        $purchasedCourses = auth()->user()->purchasedCourses;

        return view('pages.dashboard', compact('purchasedCourses'));
    }
}
