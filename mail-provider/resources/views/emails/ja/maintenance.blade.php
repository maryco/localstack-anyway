<x-mail::message>
メンテナンス実施のため、以下の日程で一部サービスがご利用いただけません。<br>
<br>

【作業予定日時】<br>
{{ $from }} ～ {{ $to }}<br>
※状況によって作業終了が遅れる場合がございます。<br>

<x-mail::button :url="config('app.url')">
メンテナンス詳細を確認する
</x-mail::button>

お問い合わせ：<a href="{{ config('app.url') }}">{{ config('app.url') }}</a><br>
<br>
{{ config('app.name') }}
</x-mail::message>
