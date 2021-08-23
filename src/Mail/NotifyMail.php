<?php 


namespace Kyawthet\ErrorShout\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Kyawthet\ErrorShout\Models\Notify;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notify;

    public function __construct(Notify $notify)
    {
        $this->notify = $notify;
    }

    public function build()
    {
        return $this->view('vendor.errorshout.emails.notify')->subject("System Error " . config('errorshout.title'))->with([
            'data' => json_decode($this->notify->data, true)
        ]);
    }
}
