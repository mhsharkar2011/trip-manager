<div class="col-lg-{{ $col }} text-center mt-4">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded']) }}>
        {{ $slot }}
    </button>
</div>