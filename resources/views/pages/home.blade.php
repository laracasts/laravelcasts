<x-guest-layout>
    <main>
        <div class="bg-indigo-500 pt-10 sm:pt-16 lg:overflow-hidden lg:pt-8 lg:pb-14">
            <div class="mx-auto max-w-7xl lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                    <div
                        class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 sm:text-center lg:flex lg:items-center lg:px-0 lg:text-left">
                        <div class="lg:py-24">
                            <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl">
                                <span class="block">A cast a day</span>
                                <span
                                    class="block bg-gradient-to-r from-yellow-500 to-yellow-200 bg-clip-text pb-3 text-transparent sm:pb-5">keeps bugs away</span>
                            </h1>
                            <p class="text-base text-gray-200 sm:text-xl lg:text-lg xl:text-xl"><strong>LaravelCasts</strong> is the
                                leading learning platform for Laravel developers.</p>
                        </div>
                    </div>
                    <div class="mt-12 -mb-16 sm:-mb-48 lg:relative lg:m-0">
                        <div class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 lg:max-w-none lg:px-0">
                            <img class="w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                                 src="{{ asset('images/coding_illustration.svg') }}"
                                 alt="Illustration of someone coding in front of a computer at home">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Courses -->
        <div class="relative bg-gray-50 py-16 sm:py-24 lg:py-32">
            <div class="relative">
                <div class="mx-auto max-w-md px-4 text-center sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8">
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Pick one of our exclusive premium courses</h2>
                    <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">All of our courses will teach you one
                        specific aspect of programming. Go step by step and never stop learning.</p>
                </div>
                <div
                    class="mx-auto mt-12 grid max-w-md gap-8 px-4 sm:max-w-lg sm:px-6 lg:max-w-7xl lg:grid-cols-3 lg:px-8">
                    @foreach($courses as $course)
                        @include('partials.home-course-item')
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Available Courses -->

    </main>
</x-guest-layout>
