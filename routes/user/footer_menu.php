<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| フッターメニュー (footer_menu)
|--------------------------------------------------------------------------
*/
    # このサイトの使い方(how_use)
    Route::get('/how_use', function () { return view('footer_menu.how_use'); })
    ->name('footer_menu.how_use');

    # 問題集公開時の注意点(important)
    // Route::get('/important', function () { return view('footer_menu.important'); })
    // ->name('footer_menu.important');

    # プライバシーポリシー(privacy_policy)
    //$revision_date 改定日
    Route::get('/privacy_policy/{revision_date?}',
    function ($revision_date='2023-09-12') {
        return view('footer_menu.privacy_policy.'.$revision_date);
    })->name('footer_menu.privacy_policy');

    # 利用規約(trems)
    Route::get('/trems', function () {
        return view('footer_menu.trems');
    })->name('footer_menu.trems');


    # 特定商取引法に基づく表記(tradelaw)
    Route::get('tradelaw/{revision_date?}',
    function ($revision_date='2024-04-01') {
        return view('footer_menu.tradelaw.index', compact('revision_date'));
    })->name('footer_menu.tradelaw');


    # お問い合わせ(contact)
    Route::get('/contact', function () { return view('footer_menu.contact'); })
    ->name('footer_menu.contact');

    # お知らせ(news)
    Route::get('/news', function () { return view('footer_menu.news'); })
    ->name('footer_menu.news');

    # よくある質問(faq)
    Route::get('/faq', function () { return view('footer_menu.faq'); })
    ->name('footer_menu.faq');

    # 運営会社について(operating_companiy)
    Route::get('/operating_companiy', function () { return redirect( env('COMPANY_URL') ); })
    ->name('footer_menu.operating_companiy');

//
