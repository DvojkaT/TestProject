<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundHttpException extends BaseHttpException
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
    protected $message = "Пользователь не найден";
}
