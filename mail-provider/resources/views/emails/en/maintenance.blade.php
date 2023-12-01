<x-mail::message>
Due to maintenance, some services will be unavailable on the following dates.<br>
<br>
## [Maintenance Schedule]
From {{ $from }} to {{ $to }}<br>
**NOTE: Depending on the situation, the completion of work may be delayed.**<br>

<x-mail::button :url="config('app.url')">
Show Details
</x-mail::button>

<a href="{{ config('app.url') }}">Contact us</a><br>
<br>
{{ config('app.name') }}
</x-mail::message>
