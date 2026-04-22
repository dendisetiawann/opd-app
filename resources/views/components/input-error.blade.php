@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'mt-2']) }}>
        @foreach ((array) $messages as $message)
            <div class="flex items-center gap-1.5 text-sm text-red-600 dark:text-red-400 animate-shake">
                <i class="fa-solid fa-circle-exclamation w-3.5 h-3.5 flex-shrink-0 flex items-center justify-center"></i>
                <span>{{ $message }}</span>
            </div>
        @endforeach
    </div>
@endif
