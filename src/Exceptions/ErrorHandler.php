<?php 

namespace Kyawthet\ErrorShout\Exceptions;

// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Kyawthet\ErrorShout\Mail\NotifyMail;
use Illuminate\Support\Facades\Mail;
use Kyawthet\ErrorShout\Models\Notify;

class ErrorHandler
{
    protected $exception;

    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;    
    }

    public function report()
    {
        // parent::report($exception);
            $errorMessage = '';
        $statusCode = $this->exception->getCode() == 0 ? 200 : $this->exception->getCode();  
        if( !method_exists($this->exception, 'getStatusCode') ) {

           // $title = config('errorshout.title');
           // $errorMessage .= "<p>Error Message:<b style='color: red;font-weight: bold;'> " . $this->exception->getMessage() . "</b></p>";
           // $errorMessage .= "<p>File: <b style='color: red;font-weight: bold;'>" . $this->exception->getFile() . "</b></p>";
           // $errorMessage .= "<p>Line No: <b style='color: red;font-weight: bold;'>" . $this->exception->getLine() . "</b></p>";
           $notified = Notify::create($this->params());
           $this->sendMail($this->getMails(), $notified);

        }
    }

    public function params()
    {
        return [
            'verified_by' => 'none',
            'fixed_by' => 'none',
            'notified_by' => 'none',
            'data' => json_encode([
                'msg' => $this->exception->getMessage(),
                'file' => $this->exception->getFile(),
                'line' => $this->exception->getLine()
            ]),
            'status' => 'unseen'
        ];
    }

    public function getMails()
    {
        return config('errorshout.mails');;
    }

    public function sendMail($mails, Notify $notify)
    {
        Mail::to($mails[0])->cc($mails)->send(new NotifyMail($notify));
    }  
    
}
