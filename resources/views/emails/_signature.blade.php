
<p>
    <small>
    ※このメールは≪{{ env('APP_NAME') }}≫ご利用のお客様に自動送信しています。<br>
    ※このメールアドレスへの返信をすることはできません。<br>
    ※ご不明な点がある場合は、下記URLのお問い合わせフォームよりご連絡ください。<br>
    ※このメールに心当たりのない場合は、破棄して頂きますようお願い致します。<br>
    </small>
</p>
<p>
    <div>====================================</div>
    <!-- サイト名　URL -->
    <div>＜サイト＞</div>
    <strong>{{env('APP_NAME')}}</strong>　{{route('home')}}<br>
    <br>
    <!-- 運営会社名　URL -->
    <div>＜運営会社＞</div>
    <strong>{{env('COMPANY_NAME')}}</strong><br>
    〒105-0003<br>
    東京都港区西新橋1-6-12 アイオス虎ノ門803<br>
    tel:03-6555-4677 fax:03-6555-4679<br>
    {{env('COMPANY_URL')}}<br><!-- URL -->
    <div>====================================</div>
</p>
