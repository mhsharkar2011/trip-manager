@props(['user'])

@if ($user)
    <img src="{{ asset('storage/clients/avatars/'.$user) }}" {{ $attributes }} alt="Avatar">
@else
    <img src="{{ asset('img/avatar.png') }}" alt="{{ $user }}'s avatar" {{ $attributes }} >
@endif