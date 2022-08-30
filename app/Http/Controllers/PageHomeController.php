<?php

namespace App\Http\Controllers;

use App\Models\Course;

class PageHomeController extends Controller
{
    public function __invoke()
    {
        $courses = Course::query()
            ->whereNotNull('released_at')
            ->orderBy('released_at', 'desc')
            ->get();

        return view('home', compact('courses'));
    }
}
