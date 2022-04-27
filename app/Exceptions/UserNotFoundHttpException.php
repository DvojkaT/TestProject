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
    protected int $statusCode = 408;

    /**
     * Сообщение об ошибке
     *
     * @var string|null
     */
    protected $message = "Ошибка в заполнении данных";
}
