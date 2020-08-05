<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Configs\ErrorConfig;
use App\Helpers\ErrorMessage;
use Throwable;

/**
 * Trait BaseExceptionTrait
 *
 * @description Расширение для исключений.
 */
trait BaseExceptionTrait
{
    /**
     * @var array $msgParams
     */
    protected $msgParams = [];

    /**
     * BaseExceptionTrait constructor.
     *
     * @param string $message
     * @param int $code
     * @param array $msgParams
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, array $msgParams = [], Throwable $previous = null)
    {
        $this->msgParams = $msgParams;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Получить параметры сообщения.
     *
     * @return array
     */
    public function getMsgParams(): array
    {
        return $this->msgParams;
    }

    /**
     * Вызов исключения.
     *
     * @param int $code
     * @param array $params
     * @param string|null $msg
     * @param string $local
     *
     * @throws Throwable
     */
    public static function throwException(int $code, array $params = [], ?string $msg = '', string $local = ErrorConfig::LOCAL_BACK): void
    {
        throw new self(ErrorMessage::geExceptionMsg($code, $params, $local) . (empty($msg) ? '' : " {$msg}"), $code, $params);
    }

    /**
     * Получить отладочную информацию.
     *
     * @return string
     */
    public function debugInfo(): string
    {
        return "Exception message: [{$this->getCode()}] {$this->getMessage()}" . PHP_EOL . $this->getTraceAsString();
    }
}
