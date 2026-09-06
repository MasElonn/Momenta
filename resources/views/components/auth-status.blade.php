@props(['status'])

@if($status)
    <div {{ $attributes->merge(['class' => 'mb-6 rounded-lg border border-[#1447E6]/20 bg-[#1447E6]/5 px-4 py-3 text-sm font-medium text-[#1447E6]']) }}>
        {{ $status }}
    </div>
@endif
