@component('mail::message')

# {{ $title }}

**Type:** {{ $type }}

{{ $message }}

@if($type == 'Meeting' && $scheduled_at != 'N/A')
**Scheduled Date & Time:** {{ $scheduled_at }}
@endif

@component('mail::button', ['url' => url('/dashboard')])
View in Portal
@endcomponent

Thanks,
**{{ config('app.name') }} Team**

@endcomponent
