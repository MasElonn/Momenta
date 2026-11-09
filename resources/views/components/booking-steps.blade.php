@props(['step' => 1])

<div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 mb-5 md:mb-6">
    <div class="flex items-center justify-between px-2 md:px-10">
        <div class="flex flex-col items-center gap-2">
            <div class="size-9 md:size-10 rounded-full {{ $step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-100 border border-gray-200 text-gray-400' }} font-semibold text-sm flex items-center justify-center {{ $step === 1 ? 'ring-4 ring-blue-100 shadow-xs' : '' }}">
                1
            </div>
            <span class="font-semibold text-xs md:text-sm {{ $step >= 1 ? 'text-blue-600' : 'text-gray-400' }}">Booking</span>
        </div>

        <div class="flex-1 h-px {{ $step >= 2 ? 'bg-blue-600' : 'bg-gray-200' }} mx-3 md:mx-6"></div>

        <div class="flex flex-col items-center gap-2">
            <div class="size-9 md:size-10 rounded-full {{ $step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-100 border border-gray-200 text-gray-400' }} font-semibold text-sm flex items-center justify-center {{ $step === 2 ? 'ring-4 ring-blue-100 shadow-xs' : '' }}">
                2
            </div>
            <span class="font-semibold text-xs md:text-sm {{ $step >= 2 ? 'text-blue-600' : 'text-gray-400 font-medium' }}">Payment</span>
        </div>

        <div class="flex-1 h-px {{ $step >= 3 ? 'bg-blue-600' : 'bg-gray-200' }} mx-3 md:mx-6"></div>

        <div class="flex flex-col items-center gap-2">
            <div class="size-9 md:size-10 rounded-full {{ $step >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-100 border border-gray-200 text-gray-400' }} font-semibold text-sm flex items-center justify-center {{ $step === 3 ? 'ring-4 ring-blue-100 shadow-xs' : '' }}">
                3
            </div>
            <span class="font-semibold text-xs md:text-sm {{ $step >= 3 ? 'text-blue-600' : 'text-gray-400 font-medium' }}">Finish</span>
        </div>
    </div>
</div>

