<x-guest-layout>

    <div class="relative py-12">
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg lg:grid lg:grid-cols-2 lg:gap-4">

                <!-- Course details -->
                <div class="order-2 md:order-1 p-8">
                    <div class="lg:self-center prose">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-4">
                            <span class="block">{{ $course->tagline }}</span>
                        </h2>
                        <p class="block text-yellow-500 text-2xl mb-0">{{ $course->title }} ({{ $course->videos_count }} videos)</p>
                        <p class="mt-4 text-lg leading-6 text-gray-900">{{ $course->description }}</p>
                        <a href="#!" data-product="{{ $course->paddle_product_id }}" data-theme="none" class="paddle_button mt-8 inline-flex items-center rounded-md border border-transparent bg-yellow-400 py-3 px-6 text-base font-medium text-gray-900 shadow hover:text-red-500">Buy
                            Now!</a>
                        <h3>Learnings</h3>
                        <ul>
                            @foreach($course->learnings as $learning)
                                <li>{{ $learning }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Course details -->

                <!-- Course image -->
                <div class="order-1 md:order-2 flex items-start aspect-w-5 aspect-h-3 md:aspect-w-2 md:aspect-h-1 p-8">
                    <img class="transform rounded-md" src="{{ asset("images/$course->image_name") }}"
                         alt="App screenshot">
                </div>
                <!-- Course image -->

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.paddle.com/paddle/paddle.js"></script>
        <script type="text/javascript">
            @env('local')
                Paddle.Environment.set('sandbox');
            @endenv
                Paddle.Setup({vendor: {{ config('services.paddle.vendor-id') }}});
        </script>
    @endpush

</x-guest-layout>


