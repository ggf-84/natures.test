<figure class="n-scene n-scene--{{ $name??'main' }}">
    <picture class="n-scene-picture">
        @if(!empty($sources) && is_array($sources))
            @foreach ($sources as $media => $srcset)
                <source media="{{ $media }}" srcset="{{ $srcset }}">
            @endforeach
        @endif
        <img class="n-scene-image" src="{{ $src }}" alt="{{ !empty($alt) ? $alt : '' }}">
    </picture>
    {{ !empty($slot) ? $slot : '' }}
</figure>