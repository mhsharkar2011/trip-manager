@props(['userAvatar'])

@if ($userAvatar)
    <img src="{{ asset('storage/customers/avatars/'.$userAvatar) }}" {{ $attributes->merge(['class'=>'rounded-circle']) }} alt="Avatar" width="48" height="48" >
@else
    <img src="{{ asset('img/avatar.png') }}" {{ $attributes->merge(['class'=>'rounded-circle']) }} alt="{{ $userAvatar }}'s avatar" width="48" height="48" >
@endif

