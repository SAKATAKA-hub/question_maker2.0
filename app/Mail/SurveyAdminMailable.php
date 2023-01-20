<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/**
 * ===================================
 *  管理者宛 / 資料請求受付
 * ===================================
*/
class SurveyAdminMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->questions = $inputs['questions'];
        $this->subject = $inputs['subject'];
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.surveyAdminComplition') //テンプレートファイルの読み込み
        ->with(['questions' => $this->questions,])
        ->with(['subject' => $this->subject,])
        ->subject(  $this->subject );// 件名
    }

}
