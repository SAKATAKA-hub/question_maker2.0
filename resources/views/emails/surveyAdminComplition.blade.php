<section>


    <p>{{ $subject }}。</p>
    <p>
        詳細については、求人応募アンケートサイト管理者ページよりご確認ください。
    </p>
    <p>
        <a href="{{ route('admin.survey'); }}">{{ route('admin.survey' ); }}</a>
    </p>
    <br>
    <br>


    @foreach ($questions as $question)
    <div>
        <strong>{{ $question->text }}：</strong> <br>
        {!! str_replace(["\r\n","\r","\n"],"<br>", e( $question->input ) ) !!}
    </div><br>
    @endforeach



</section>
