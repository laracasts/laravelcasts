<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Contracts\View\View;

class PageVideosController extends Controller
{
    public function __invoke(Course $course, Video $video): View
    {
        $video = $video->exists ? $video : $course->videos()->first();

        return view('pages.videos', compact('video'));
    }
}
