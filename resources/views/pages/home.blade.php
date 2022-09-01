@foreach($courses as $course)
    <a href="{{ route('page.course-details', $course) }}">
        <h2>{{ $course->title }}</h2>
    </a>
    <p>{{ $course->description }}</p>
@endforeach
