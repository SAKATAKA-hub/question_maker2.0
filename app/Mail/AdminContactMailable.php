<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/**
 * ===================================
 *  管理者宛 / お問い合わせ受付け
 * ===================================
*/
class AdminContactMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $inputs = $this->inputs;

        return $this->view('emails.admin_contact') //テンプレートファイルの読み込み
        ->with([
            'inputs' => $inputs,
        ])->subject('お客様よりお問い合わせを受け付けました');// 件名
    }
}
