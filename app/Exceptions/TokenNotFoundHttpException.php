<?php

namespace App\Exceptions;

class TokenNotFoundHttpException extends BaseHttpException
{
    /**
     * HTTP код ошибки
     *
     * @var int
     */
    protected int $statusCode = 404;

    /**
     * Сообщение об ошибке
     *
     * @var string|null
     */
    protected $message = "Пользователь с таким токеном не найден";
}
