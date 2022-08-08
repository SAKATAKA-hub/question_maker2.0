<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/*
|--------------------------------------------------------------------------
| メール
|--------------------------------------------------------------------------
*/
class SendMailMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->inputs = $data['inputs'];
        $this->view = $data['view'];
        $this->subject = $data['subject'];
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view) //テンプレートファイルの読み込み
        ->with(['inputs' => $this->inputs,])
        ->subject($this->subject);// 件名
    }

}
