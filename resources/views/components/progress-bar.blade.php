<div class="stats-info bg-dark border-dark">
    <p>{{ $label }} <strong>{{ $value }} <small>/ {{ $totalValue }}</small></strong></p>
    <div class="progress">
        <div class="progress-bar bg-{{ $bg }}" role="progressbar" style="width: {{ $value }}%" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="{{ $totalValue }}">{{ $slot }}</div>
    </div>
</div>