@props([
    'status',
])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-success text-center']) }}>
        {{ $status }}
    </div>
@endif
{{-- @if ($status) --}}
    {{-- <div class="font-medium text-sm text-success text-center">
        test
    </div> --}}
{{-- @endif --}}
