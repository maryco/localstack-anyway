<x-mail::message>
# You have deleted your {{ config('app.name') }} account
<br>
This email is to confirm that you’ve deleted your {{ $account }} account from {{ config('app.name') }}.<br>
<br>
Your repositories and content have been deleted from the system and your {{ $account }} username will be available for registration on a new account after 90 days.<br>
<br>
If you were on a paid plan, you will not be billed again.<br>
<br>
We’re sorry to see you go. You can reply directly to this email if you have any questions or feedback. We’d love to hear from you.<br>
<br>
You’re receiving this email because you deleted your account on {{ config('app.name') }}.<br>
<br>
{{ config('app.name') }}
</x-mail::message>
