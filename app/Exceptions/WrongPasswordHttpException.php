<?php

namespace App\Exceptions;

class WrongPasswordHttpException extends BaseHttpException
{
    /**
     * HTTP код ошибки
     *
     * @var int
     */
    protected int $statusCode = 408;

    /**
     * Сообщение об ошибке
     *
     * @var string|null
     */
    protected $message = "Введён неверный пароль";
}
