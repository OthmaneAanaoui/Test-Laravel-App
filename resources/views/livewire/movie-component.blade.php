<div>
    <div class="mb-4">
        <input class="input" type="text" class="form-control" placeholder="Search Movies..." wire:model.debounce.300ms="search">

    </div>

    <div class="grid mb-8 border border-gray-200 rounded-lg shadow-sm md:mb-12 md:grid-cols-2 bg-white">
        @foreach ($movies as $movie)
        <div class="container my-12 mx-auto px-4 md:px-12" :key="{{ $movie->id }}">
            <div class="flex flex-wrap -mx-1 lg:-mx-4">
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <a href="#">
                            <img alt="Placeholder" class="block h-auto w-full" src="http://image.tmdb.org/t/p/w500/{{ $movie->backdrop_path }}">
                        </a>
                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <h1 class="text-lg">
                                <a wire:click="edit({{ $movie->id }})" class="no-underline text-black hover:underline" href="#">
                                    {{ $movie->name ?? $movie->title }}
                                </a>
                            </h1>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded ms-3">{{ number_format($movie->vote_average, 1) }}</span>
                        </header>
                        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                            <a class="flex items-center no-underline hover:underline text-black" href="#">
                                <p class="text-grey-darker text-sm">
                                    {{$movie->overview}}
                                </p>
                            </a>
                            <div>
                                <button wire:click="delete({{ $movie->id }})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-800 ml-2">
                                    Delete
                                </button>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 flex justify-center">
        {{ $movies->links() }}
    </div>

    @if ($isOpen)
    @include('livewire.movie-edit')
    @endif
</div>