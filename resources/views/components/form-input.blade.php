<div class="form-group col-lg-{{ $col }} mt-2">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes->merge(['class'=>'form-control']) }}>
</div>
