<x-mail::message>
# あなたの{{ config('app.name') }} アカウントはもうすぐ完全に削除されます。
{{ $name }}様<br>
<br>
あなたのアカウント「 {{ $email }}」は完全に削除されます。<br>
3日以内であればキャンセル可能です。<br>
<br>
ご利用いただきありがとうございました。<br>
<br>
<a href="{{ config('app.url') }}">プライバシーポリシー</a> • <a href="{{ config('app.url') }}">お問い合わせ</a><br>
<br>
{{ config('app.name') }}
</x-mail::message>
