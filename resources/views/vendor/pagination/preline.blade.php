@if ($paginator->hasPages())
    <!-- Pagination -->
    <nav class="flex items-center gap-x-1" aria-label="Pagination">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <button type="button" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" aria-label="Previous" disabled>
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                <span>Previous</span>
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus" aria-label="Previous">
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                <span>Previous</span>
            </a>
        @endif

        {{-- Page numbers --}}
        <div class="flex items-center gap-x-1">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="min-h-9.5 min-w-9.5 flex justify-center items-center text-foreground py-2 px-3 text-sm">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button type="button" class="min-h-9.5 min-w-9.5 flex justify-center items-center bg-surface-1 text-foreground py-2 px-3 text-sm rounded-lg focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none" aria-current="page" disabled>{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="min-h-9.5 min-w-9.5 flex justify-center items-center text-foreground hover:bg-muted-hover py-2 px-3 text-sm rounded-lg focus:outline-hidden focus:bg-muted-focus">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus">
                <span>Next</span>
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        @else
            <button type="button" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" disabled>
                <span>Next</span>
                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        @endif
    </nav>
    <!-- End Pagination -->
@endif
