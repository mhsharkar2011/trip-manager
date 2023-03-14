
<div class="col-md-{{ $col }}">
    <div class="card-group m-b-30">
        <div class="card bg-{{ $bgdark }} text-{{ $color }} border-secondary">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div> <span class="d-block">{{ $title }}</span> </div>
                    <div> <span class="text-success">${{ $headerValue }}</span> </div>
                </div>
                <h3 class="mb-3">{{ $totalValue ?? '0' }}</h3>

                @php
                use Carbon\Carbon;
                $now = Carbon::now();
                $startOfMonth = $now->copy()->startOfMonth();
                $endOfMonth = $now->endOfMonth();
                $daysInMonth = $startOfMonth->diffInDays($endOfMonth)+1;
                // Set the progress bar min and max values
                $minValue = $startOfMonth->day;
                $maxValue = Carbon::now()->day;
                // $progress = $totalValue > 0 ? round(($totalValue / $daysInMonth) * 100,2) : 0;
                @endphp
                
                <div class="progress mb-2" style="height: 5px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $daysInMonth}}%;" aria-valuenow="{{ $totalValue ??  $minValue }}" aria-valuemin="{{$minValue }}" aria-valuemax="{{ $maxValue }}"></div>
                </div>
                <p class="mb-0">{{ $footerTitle }} {{ $footerValue ?? '0' }}</p>
            </div>
        </div>
        
    </div>
</div>