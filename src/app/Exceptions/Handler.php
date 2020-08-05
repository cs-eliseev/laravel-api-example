<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Вывод ошибок в лог.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        // Ignore Unauthorized
        if ($exception instanceof OAuthServerException && $exception->getCode() == 9) {
            return;
        }

        parent::report($exception);
    }

    /**
     * Вывод ошибок.
     *
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        $message = null;
        $error = null;

        switch (true) {
            case $exception instanceof UnauthorizedHttpException:
            case $exception instanceof AuthenticationException:
                $code = $request->hasHeader('Authorization')
                    ? Response::HTTP_UNAUTHORIZED
                    : Response::HTTP_NOT_FOUND;
                break;
            case $exception instanceof ValidationException:
                $code = Response::HTTP_UNPROCESSABLE_ENTITY;
                break;
            case $exception instanceof \InvalidArgumentException:
                $code = Response::HTTP_BAD_REQUEST;
                break;
            default:
                $code = empty($exception->getMessage()) ? Response::HTTP_NOT_FOUND : Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
        }

        return response()->jsonFormat(false, $message, $error, $code);
    }

    /**
     * Неавторизованный пользователь.
     *
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     *
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->hasHeader('Authorization')) {
            $code = Response::HTTP_UNAUTHORIZED;

            return response()->jsonFormat(false, null, null, $code);
        }

        return redirect()->guest('login');
    }
}
