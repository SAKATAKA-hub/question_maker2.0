<div>
    ≪{{ env('APP_NAME') }}≫をご利用いただきありがとうございます。<br>
    お客様のお手続きにより、パスワード変更が完了いたしましたのでお知らせします。<br>
</div>
<br>
<div>
    ログイン情報は、お忘れになったり、他人に知られたりすることのないよう、<br>
    厳重な管理をお願いします。<br>
</div>
<br>
<div>
    引き続き、≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
</div>
<br>

<!-- 共通署名 -->
@include('emails._signature')
