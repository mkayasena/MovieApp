<div class="relative" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input wire:model.debounce.50ms="search" 
           wire:keydown="performSearch"
           wire:keydown.enter="showResultsOnEnter"
           type="text" 
           class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 text-sm focus:outline-none focus:shadow-outline" 
           placeholder="search"
           x-ref="search"
           @keydown.window="
                if (event.key === '/' || event.code === 'Slash') {
                    event.preventDefault();
                    $refs.search.focus();
                }
            "
           @focus = "isOpen = true"
           @keydown= "isOpen = true"
           @keydown.escape.window="isOpen = false"
           @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current text-gray-588 w-4 mt-2 ml-2" viewBox="-2.5 -2.5 24 24" preserveAspectRatio="xMinYMin" class="jam jam-search">
            <path d='M8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12zm6.32-1.094l3.58 3.58a1 1 0 1 1-1.415 1.413l-3.58-3.58a8 8 0 1 1 1.414-1.414z'/>
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

    @if (strlen($search) >= 2)

        <div class="z-50 absolute text-sm bg-gray-800 rounded w-64 mt-4" 
             x-show.transition.opacity="isOpen"
        >
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movies.show', $result['id']) }}" 
                               class="block hover hover:bg-gray-700 px-3 py-3 flex items-center"
                               @if ($loop->last) @keydown.tab.exact="isOpen = false" @endif  {{-- $loop->last:döngünün son öğesi. son ögeye gelindikten sonra tekrar taba basılırsa pencere kapanır, shift tabda geri döner--}}
                            >
                                @if ($result['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-8">
                                @else 
                                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                                @endif
                                <span class="ml-4"> {{ $result['title'] }} </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
            
        </div>
    @endif       
</div>
