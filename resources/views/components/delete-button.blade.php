@props(['route', 'label', 'icon'])

<form action="{{ $route }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" {{$attributes}} >
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label ?? '' }}
    </button>
</form>
