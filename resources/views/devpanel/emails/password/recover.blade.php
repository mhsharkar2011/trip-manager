@component('mail::message')
{{ $details['title'] }}

@if (isset($details['code']))
#  {{ $details['code'] }}
@endif

@if (isset($details['password']))
#  {{ $details['password'] }}
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
