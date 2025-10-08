@props([
    'title',
    'description',
])

{{-- <div class="flex w-full flex-col text-center">
    <flux:heading size="xl">{{ $title }}</flux:heading>
    <flux:subheading>{{ $description }}</flux:subheading>
</div> --}}
<div class=" w-full flex-col text-center">
    <h4>{{ $title }}</h4>
    <h6>{{ $description }}</h6>
</div>
