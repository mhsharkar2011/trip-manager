<div class="col-md-{{ $col }}">
    <div class="card-group m-b-30">
        <div class="card bg-{{ $bgdark }} text-{{ $color }} border-secondary">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div> <span class="d-block">{{ $title }}</span> </div>
                    <div> <span class="text-success">{{ $percent }}%</span> </div>
                </div>
                <h3 class="mb-3">{{ $totalValue ?? '0' }}</h3>
                <div class="progress mb-2" style="height: 5px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $totalValue ?? '0' }}%;" aria-valuenow="{{ $totalValue ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mb-0">{{ $footerTitle }} {{ $totalValue ?? '0' }}</p>
            </div>
        </div>
        
    </div>
</div>