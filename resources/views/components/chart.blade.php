@props(['title', 'chartId','color'])

<div class="col-md-6 text-center {{ $color }}">
    <div class="card border-secondary" style="border:1px solid #333; border-radious:6px">
        <div class="card-body bg-dark">
            <h3 class="card-title {{ $color }}">{{ $title }}</h3>
            <div id="{{ $chartId }}"></div>
        </div>
    </div>
</div>