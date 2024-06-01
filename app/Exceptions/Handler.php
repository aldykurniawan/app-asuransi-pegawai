<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                throw new CustomException($e, 'HTTPNOTFOUND', 'Record not found.', 401);
            }
        });
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                throw new CustomException($e, 'UNAUTHORIZED', 'Unauthenticated.', 401);
            }
        });
        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            if ($request->is('api/*')) {
                throw new CustomException($e, 'ACCESS_ROLE', 'You do not have the required authorization.', 403);
            }
        });
    }
}
