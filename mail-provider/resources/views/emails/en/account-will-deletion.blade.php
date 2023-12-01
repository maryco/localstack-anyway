<x-mail::message>
# Your {{ config('app.name') }} account will be permanently deleted soon
Hi {{ $name }},<br>
<br>
This email is to confirm that we'll permanently delete your account, {{ $email }}.<br>
<br>
If you changed your mind, log in to your account and cancel the deletion within 3 days.<br>
<br>
Thanks so much for using {{ config('app.name') }} products.<br>
<br>
Cheers,<br>
The {{ config('app.name') }}<br>
<br>
<a href="{{ config('app.url') }}">Privacy Policy</a> • <a href="{{ config('app.url') }}">Contact us</a><br>
<br>
{{ config('app.name') }}
</x-mail::message>
