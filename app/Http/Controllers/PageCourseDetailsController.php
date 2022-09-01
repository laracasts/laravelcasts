<?php

namespace App\Http\Controllers;

use App\Models\Course;

class PageCourseDetailsController extends Controller
{
    public function __invoke(Course $course)
    {
        $course = $course->loadCount('videos');

        return view('pages/course-details', compact('course'));
    }
}
