@props(['title', 'chartId','color'])

<div class="col-md-6 text-center {{ $color }}">
    <div class="card border-secondary">
        <div class="card-body bg-dark">
            <h3 class="card-title {{ $color }}">{{ $title }}</h3>
            <div id="{{ $chartId }}"></div>
        </div>
    </div>
</div>