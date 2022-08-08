/*
| =========================================
|   フォームのページ離脱防止アラート
|    page_exit_prevention_alert
|
|   ※1.フォームにonsubmit="stopOnbeforeunload()"を指定する。
|   ※2.scriptタグを読込む。
|   <script src="{{asset('js/page_exit_prevention_alert.js')}}"></script>
| =========================================
*/
/* リロードアラート */
window.onbeforeunload = function(e) {
    return 'hoge';
};

/* フォーム送信時に、アラートの解除 */
const stopOnbeforeunload = function(){
    console.log('stopOnbeforeunload');
    window.onbeforeunload = null;
};
