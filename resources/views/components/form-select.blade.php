@props(['options', 'name', 'label','col'])

<div {{ $attributes->merge(['class' => 'mt-2']) }}>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-select form-select-md" name="{{ $name }}" id="{{ $name }}">
        <option value="" selected>Select an option</option>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
</div>
