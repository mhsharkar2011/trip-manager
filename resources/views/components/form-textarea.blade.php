<div {{ $attributes->merge(['class'=>'form-floating']) }} >
    <textarea class="form-control" for="{{ $for }}" id="{{ $id }}" name="{{ $name }}"  placeholder="{{ $placeholder }}"  style="{{ $style }}" > {{ $value }} </textarea>
    <label for="{{ $for }}">{{ $label }}</label>
