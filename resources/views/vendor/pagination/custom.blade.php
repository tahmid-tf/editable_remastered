@if ($paginator->hasPages())
    <nav class="flex items-center justify-center mt-4 space-x-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 border rounded">&lt;</span>
        @else
            <button
                wire:click="previousPage"
                wire:loading.attr="disabled"
                class="px-3 py-1 border rounded hover:bg-gray-200"
                style="text-decoration: none; color: black"
            >
                &lt;
            </button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Dots --}}
            @if (is_string($element))
                <span class="px-3 py-1 border rounded">{{ $element }}</span>
            @endif

            {{-- Page Numbers --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 border rounded bg-black text-white">{{ $page }}</span>
                    @else
                        <button
                            wire:click="gotoPage({{ $page }})"
                            wire:loading.attr="disabled"
                            class="px-3 py-1 border rounded hover:bg-gray-200"
                            style="text-decoration: none; color: black"
                        >
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button
                wire:click="nextPage"
                wire:loading.attr="disabled"
                class="px-3 py-1 border rounded hover:bg-gray-200"
                style="text-decoration: none; color: black"
            >
                &gt;
            </button>
        @else
            <span class="px-3 py-1 border rounded">&gt;</span>
        @endif
    </nav>
@endif
