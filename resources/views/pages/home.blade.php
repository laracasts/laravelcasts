@guest()
    <a href="{{ route('login') }}">Login</a>
@else
    <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf

            <button type="submit">{{ __('Log Out') }}</button>
    </form>
@endguest

@foreach($courses as $course)
    <a href="{{ route('page.course-details', $course) }}">
        <h2>{{ $course->title }}</h2>
    </a>
    <p>{{ $course->description }}</p>
@endforeach
