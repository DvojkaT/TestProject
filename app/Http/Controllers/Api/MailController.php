<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Abstracts\MailServiceInterface;
use App\Services\MailService;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public MailServiceInterface $service;

    public function __construct(MailServiceInterface $service)
    {
        $this->service = $service;
    }

    public function sendMail()
    {
        return $this->service->sendMail();
    }
}
