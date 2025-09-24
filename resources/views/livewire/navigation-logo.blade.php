<div class="shrink-0 flex items-center">
    @if(!empty($config?->logo))
        {{-- Caso futuro: si el logo viene de la BD --}}
        <img 
            src="{{ Str::startsWith($config->logo, ['http://', 'https://', 'img/']) 
                    ? asset($config->logo) 
                    : asset('img/' . $config->logo) }}" 
            alt="Logo" 
            class="{{ $size }}" >
    @else
        {{-- Caso actual: logo fijo en public/img/logo/logo.png --}}
        <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" class="h-48 w-auto">
    @endif
</div>
