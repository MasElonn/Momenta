@php
    $current = app()->getLocale();
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center rounded-lg border border-gray-200 bg-white p-0.5 text-xs font-semibold shadow-xs']) }}>
    <a href="{{ route('lang.switch', 'id') }}"
       class="rounded-md px-2 py-0.5 transition-colors {{ $current === 'id' ? 'bg-blue-600 text-white shadow-xs' : 'text-gray-500 hover:text-gray-900' }}">
        ID
    </a>
    <a href="{{ route('lang.switch', 'en') }}"
       class="rounded-md px-2 py-0.5 transition-colors {{ $current === 'en' ? 'bg-blue-600 text-white shadow-xs' : 'text-gray-500 hover:text-gray-900' }}">
        EN
    </a>
</div>
