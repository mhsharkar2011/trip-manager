<div {{ $attributes->merge(['class' => 'col-md-6 col-sm-6 col-lg-6 col-xl-3']) }}>
    <div class="card dash-widget">
        <div class="card-body">
            <span class="dash-widget-icon"><i class="{{ $icon }}"></i></span>
            <div class="dash-widget-info">
                <h3>{{ $count }}</h3>
                <span>{{ $label }}</span>
            </div>
        </div>
    </div>
</div>
