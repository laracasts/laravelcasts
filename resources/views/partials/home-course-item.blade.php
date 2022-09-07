<div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
    <div class="flex-shrink-0">
        <a href="{{ route('page.course-details', $course) }}">
            <img class="h-48 w-full object-cover"
                 src="{{ asset("images/$course->image_name") }}"
                 alt="Cover image for the course {{ $course->title }}">
        </a>
    </div>
    <div class="flex flex-1 flex-col justify-between bg-white p-6">
        <div class="flex-1">
            <p class="text-sm font-medium text-yellow-500">
                <a href="#" class="hover:underline">Video course</a>
            </p>
            <a href="{{ route('page.course-details', $course) }}" class="mt-2 block">
                <p class="text-xl font-semibold text-gray-900">{{ $course->title }}e</p>
                <p class="mt-3 text-base text-gray-500">{{ $course->description }}</p>
            </a>
        </div>
    </div>
</div>
