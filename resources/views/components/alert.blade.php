@if (session('success') || session('error') || session('warning'))
    <div class="absolute flex justify-end m-6 bottom-0 right-0">
        <div id="dismiss-alert"
             @class([
                 'justify-end w-fit hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 border text-sm rounded-lg p-4 shadow',
                 'bg-teal-100 border-teal-200 text-teal-800 dark:bg-teal-500/20 dark:border-teal-900 dark:text-teal-400' => session('success'),
                 'bg-red-100 border-red-200 text-red-800 dark:bg-red-500/20 dark:border-red-900 dark:text-red-400' => session('error'),
                 'bg-yellow-100 border-yellow-200 text-yellow-800 dark:bg-yellow-500/20 dark:border-yellow-900 dark:text-yellow-400' => session('warning'),
             ])
             role="alert" tabindex="-1" aria-labelledby="hs-dismiss-button-label">
            <div class="flex">
                <div class="shrink-0">
                    @if (session('success'))
                        <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                    @elseif (session('error'))

                        <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="m15 9-6 6"/>
                            <path d="m9 9 6 6"/>
                        </svg>
                    @else

                        <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.46 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>
                    @endif
                </div>
                <div class="ms-2">
                    <h3 id="hs-dismiss-button-label" class="text-sm font-medium">
                        {{ session('success') ?? session('error') ?? session('warning') }}
                    </h3>
                </div>
                <div class="ps-3 ms-auto">
                    <div class="-mx-1.5 -my-1.5">
                        <button type="button"
                                @class([
                                    'inline-flex rounded-lg p-1.5 focus:outline-hidden',
                                    'bg-teal-50 text-teal-500 hover:bg-teal-100 focus:bg-teal-100 dark:bg-transparent dark:text-teal-600 dark:hover:bg-teal-800/50 dark:focus:bg-teal-800/50' => session('success'),
                                    'bg-red-50 text-red-500 hover:bg-red-100 focus:bg-red-100 dark:bg-transparent dark:text-red-600 dark:hover:bg-red-800/50 dark:focus:bg-red-800/50' => session('error'),
                                    'bg-yellow-50 text-yellow-500 hover:bg-yellow-100 focus:bg-yellow-100 dark:bg-transparent dark:text-yellow-600 dark:hover:bg-yellow-800/50 dark:focus:bg-yellow-800/50' => session('warning'),
                                ])
                                data-hs-remove-element="#dismiss-alert">
                            <span class="sr-only">Dismiss</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"/>
                                <path d="m6 6 12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
