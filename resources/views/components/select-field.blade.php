@props(['options', 'name', 'label'])

<label for="{{ $name }}">{{ $label }}</label>
<select name="{{ $name }}" id="{{ $name }}" class="form-select bg-dark text-white border-1" style="height: 40px;">
    <option value="" selected>Select an option</option>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
