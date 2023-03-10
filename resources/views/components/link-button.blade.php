@props(['route', 'label', 'icon'])
    <a href=" {{  $route }} " {{$attributes}} >
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label ?? '' }}
    </a>
</form>
