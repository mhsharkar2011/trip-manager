
<div class="col-md-6 col-sm-6 col-lg-6 col-xl-{{ $col ?? '3' }}">
    <div class="card text-{{ $color ?? 'white' }} shadow mb-5 rounded-3 border-secondary bg-{{ $bgcolor='dark' }} o-hidden">
        <div class="card-body">  
            <span class="dash-widget-icon"><i class="{{ $icon }}"></i></span>
            <div class="dash-widget-info">
                <h3>{{ $count }}</h3>
                <span>{{ $label }}</span>
            </div>
        </div>
    </div>
</div>


{{-- 
<div class="col-xl-{{ $col ?? '3' }} col-sm-6 mb-3">
    <div class="card text-{{ $color ?? 'white' }} shadow p-3 mb-5 rounded-3 bg-{{ $bgcolor='dark' }} o-hidden h-80">
        <div class="card-body">
            <div class="text-center">
                <h3>{{ $count }}</h3> {{ $label }}
            </div>
        </div>
        <a class="card-footer rounded-3 text-{{ $linkcolor ?? 'white' }} clearfix small z-1" href="{{ $link }}">
            <span class="float-left">{{ $linktext }}</span>
            <span class="float-right">
                <i class="fas fa-angle-right"></i>
            </span>
        </a>
    </div>
</div> --}}