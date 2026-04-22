@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'mt-1.5 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <div class="flex items-start gap-1.5 text-[11px] font-medium text-red-500 dark:text-red-400 animate-shake">
                <i class="fa-solid fa-circle-exclamation text-[10px] flex-shrink-0 mt-0.5"></i>
                <span class="leading-tight">{{ $message }}</span>
            </div>
        @endforeach
    </div>
@endif
