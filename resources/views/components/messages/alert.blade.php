@props(['status','route'])

@if ($status)
<div class="alert alert-success">
    {{ $status }}
    Click <a href="{{ $route }}">here</a>
</div>
@endif
