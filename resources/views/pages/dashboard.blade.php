<x-app-layout>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="space-y-12">
                <div class="space-y-5 sm:space-y-4 md:max-w-xl lg:max-w-3xl xl:max-w-none">
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Purchased courses</h2>
                    <p class="text-xl text-gray-500">On the dashboard you can find your purchased courses.</p>
                </div>
                <ul role="list"
                    class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 sm:space-y-0 lg:grid-cols-3 lg:gap-x-8">

                    @foreach($purchasedCourses as $purchasedCourse)
                        <li>
                            @include('partials.purchase-course-list-item')
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
