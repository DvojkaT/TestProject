<?php

namespace App\Services;

use App\Mail\RestorePassword;
use App\Services\Abstracts\MailServiceInterface;
use Illuminate\Support\Facades\Mail;

class MailService implements MailServiceInterface
{
    /**
     * @inheritDoc
     */
    public function sendMail()
    {
        $text = new RestorePassword;
        Mail::to("misterDvojka@yandex.ru")->send($text);
        return back();
    }
}
