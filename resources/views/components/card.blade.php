{{-- <div class="col-xl-{{ $col ?? '3' }} col-sm-6 mb-3">
    <div class="card text-white bg-{{ $bgColor ?? 'success' }} o-hidden h-100">
        <div class="card-body">
            <div class="text-{{ $align ?? 'center' }}">
                <h3>{{ $value }}</h3> {{ $title }}
            </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="{{ $link }}">
            <span class="float-left">{{ $linkText }}</span>
            <span class="float-right">
                <i class="fas fa-angle-right"></i>
            </span>
        </a>
    </div>
</div> --}}



<div class="col-xl-{{ $col ?? '3' }} col-sm-6 mb-3">
    <div class="card text-{{ $color ?? 'white' }} bg-{{ $bgcolor }} o-hidden h-100">
        <div class="card-body">
            <div class="text-center">
                <h3>{{ $count }}</h3> {{ $label }}
            </div>
        </div>
        <a class="card-footer text-{{ $linkcolor ?? 'white' }} clearfix small z-1" href="{{ $link }}">
            <span class="float-left">{{ $linktext }}</span>
            <span class="float-right">
                <i class="fas fa-angle-right"></i>
            </span>
        </a>
    </div>
</div>
