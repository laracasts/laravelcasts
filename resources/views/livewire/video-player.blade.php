<div>
    <div class="mx-auto max-w-7xl py-8">

        <div class="flex flex-col md:flex-row my-24">

            <!-- Video -->
            <div class="w-full md:w-3/4 p-6 md:p-0">
                <iframe class="w-full aspect-video rounded mb-4 md:mb-8" src="https://player.vimeo.com/video/{{ $video->vimeo_id }}" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <div class="flex justify-end">
                    @if($video->alreadyWatchedByCurrentUser())
                        <button class="bg-yellow-400 hover:bg-yellow-500 py-2 px-4 rounded-md text-xs"
                                wire:click="markVideoAsNotCompleted">Mark as <strong>not</strong> completed
                        </button>
                    @else
                        <button class="bg-yellow-400 hover:bg-yellow-500 py-2 px-4 rounded-md text-xs"
                                wire:click="markVideoAsCompleted">Mark as completed
                        </button>
                    @endif
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-2">{{ $video->title }} ({{ $video->getReadableDuration() }})</h3>
                    <p>{{ $video->description }}</p>

                </div>
            </div>
            <!-- Video -->

            <!-- Video list -->
            <div class="w-full md:w-1/4 p-6 md:p-0">
                <div>
                    <ul role="list" class="md:ml-12 divide-y divide-gray-200">
                        @foreach($courseVideos as $courseVideo)
                            <li class="py-4">
                                <div class="flex space-x-3">
                                    @include('partials.svg.play')
                                    <div class="flex-1 space-y-1">
                                        <div class="flex items-center justify-between">
                                            @if($this->isCurrentVideo($courseVideo))
                                                <h3 class="text-md font-bold">{{ $courseVideo->title }} @if($courseVideo->alreadyWatchedByCurrentUser())✅@endif</h3>
                                            @else
                                                <a href="{{ route('page.videos', [$courseVideo->course, $courseVideo]) }}">
                                                    <h3 class="text-md font-medium">{{ $courseVideo->title }} @if($courseVideo->alreadyWatchedByCurrentUser())✅@endif</h3>
                                                </a>
                                            @endif
                                            <p class="text-sm text-gray-500">{{ $courseVideo->getReadableDuration() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Video list -->

        </div>
    </div>
</div>

