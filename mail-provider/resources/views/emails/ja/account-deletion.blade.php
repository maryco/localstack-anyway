<x-mail::message>
# アカウントは削除されました。
<br>
{{ config('app.name') }}からあなたのアカウント「 {{ $account }}」が削除されたことをお知らせします。<br>
<br>
あなたのリポジトリとコンテンツはシステムから削除され、90 日後に「 {{ $account }} 」は新しいアカウントとして登録できるようになります。<br>
<br>
有料プランを利用していた場合、再度請求されることはありません。<br>
<br>
ご質問やフィードバックがございましたら、このメールに直接ご返信ください。 あなたからの御一報をお待ちしています。<br>
<br>
{{ config('app.name') }}
</x-mail::message>