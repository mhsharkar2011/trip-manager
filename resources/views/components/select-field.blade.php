@props(['options', 'name', 'label','value'])

<label for="{{ $name }}">{{ $label}}</label>
<select name="{{ $name }}" id="{{ $name }}" class="form-select border-1" style="height: 40px;">
    <option value="{{ $value }}" selected></option>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
