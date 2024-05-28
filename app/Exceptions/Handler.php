<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthenticated',
                'data' => null,
            ], 401);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'code' => 405,
                'message' => 'Method Not Allowed',
                'data' => null,
            ], 405);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'code' => 404,
                'message' => 'Not Found',
                'data' => null,
            ], 404);
        });
    }
}
