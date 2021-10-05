@component('mail::message')
# {{ $details['title'] }}

#  {{ $details['code'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
