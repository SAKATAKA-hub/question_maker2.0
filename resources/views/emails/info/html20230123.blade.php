<!DOCTYPE html>
<html lang="ja">
<head>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{--
        /*
         @ padding　使用不可
         @ rem 使用不可
         @ colorは#------
        */

    --}}
    <style>
        .top-logo{
            width: 160px;
            margin: 0 auto;
        }
        img{
            display: block;
            width: 100%;
        }
        .copy{
            margin: 16px 0;
            text-align: center;
            color: #a3b6c2;
        }
        .border-bottom{ border-bottom: 1px solid #a3b6c2; }
        .text-end{ text-align: right; }
        .mail-container{
            max-width: 600px;
            padding: 0 1rem;
            margin: 32px auto;
        }
        .bg-light-text{
            background-color: #e0e7eb;
            padding: 16px;
        }
        .text-center{ text-align: center; }
        .btn{
            display: inline-block;
            font-weight: 400;
            line-height: 1.6;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            user-select: none;
            border: none;
            padding: 8px 16px;
            font-size: 18px;
            border-radius: 4.8px;
            color: #fff;
            background-color: #14CFA0;
            /* width: 100%; */
            /* margin: 16px 0; */
        }
    </style>
</head>
<body>
    <header>
        <div class="mail-container">
            <div class="top-logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('storage/site/image/logo_lg.png')}}" alt="{{ env('APP_NAME') }}">
                </a>
            </div>
        </div>
    </header>
    <div class="mail-container border-bottom">
        <!--Title-->
        <h3 class="">サービス向上アンケートのお願い</h3>
    </div>
    <div class="mail-container border-bottom">
        <p>
            いつも≪{{ env('APP_NAME') }}≫をご利用いただき、ありがとうございます。<br>
            <br>

            当サイトのサービス向上を目的とした、簡単なアンケートをお願いしています。<br>
            <strong> 5分ほど</strong>
            の簡単なアンケートですので、是非ともご協力頂けますよう、よろしくお願い致します。<br>
            <br>

            引き続き、≪{{ env('APP_NAME') }}≫をよろしくお願い致します。<br>
        </p>
    </div>
    <div class="mail-container">
        <p class="text-center">
            <a class="btn btn-primary btn-lg"
            href="https://nextarrow.heteml.net/hr/survey/input/3/1K6ljOnJABKxwIOkRBbesqa38zjpqx8AGGj7QZmP"
            >アンケートはこちら</a>
        </p>
    </div>
    <br>
    <footer>
        <div class="mail-container">
            <p class="bg-light-text">
                <small>
                    このメールは≪{{ env('APP_NAME') }}≫ご利用のお客様に自動送信しています。
                    <br>
                    このメールアドレスへの返信をすることはできません。
                    <br>
                    当社から送信されるメールのメッセージ及び添付物には、機密情報を含んでいる場合がございます。
                    <br>
                    当社から送信されたメールに心当たりがない場合、速やかに送信元へその旨をご連絡いただき、本メール及び本メールの添付物をすべて破棄していただけますようお願い申し上げます。
                    <br>
                    誤って着信したメールを、自己のために利用することや、第三者への開示は固く禁止いたします。
                    <br>
                    Email messages and attachments sent from us may contain confidential information.
                    <br>
                    If you do not recognize the e-mail sent from our company, please contact the sender as soon as possible and discard this e-mail and all attachments to this e-mail.
                    <br>
                    It is strictly prohibited to use emails received by mistake for your own benefit or to disclose them to third parties.
                </small>
            </p>
            <div class="">
                <a href="{{env('COMPANY_URL')}}">{{env('COMPANY_NAME')}}</a>
            </div>
            <div class="copy">&copy; TOSUMA Co.,Ltd.</div>
        </div>
    </footer>
</body>
</html>


