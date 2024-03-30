<?php

use App\Http\Middleware\AuthorizeAdmin;
use App\Http\Middleware\JwtMiddleware;
use App\src\Exceptions\CommonException;
use Exception as BaseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web:      __DIR__ . '/../routes/web.php',
        api:      __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health:   '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                'permissions' => AuthorizeAdmin::class,
                'auth'        => JwtMiddleware::class,
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(
            function (BaseException $exception, Request $request) {
                report($exception);
                if (!$exception instanceof CommonException
                    && $request->expectsJson()
                ) {
                    if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
                        return \response()->json(
                            'Record Not Found',
                            Response::HTTP_NOT_FOUND
                        );
                    }
                    if ($exception instanceof ValidationException) {
                      $exceptionValidation = [
                        'errors'  => $exception->errors(),
                        'message' => $exception->getMessage(),
                      ];

                      return response()->json($exceptionValidation, Response::HTTP_BAD_REQUEST);
                    }
                    $exceptionContent = [
                        'message'        => $exception->getMessage(),
                        'exception_code' => CommonException::DEFAULT_CODE,
                    ];
                    if (env('LARAVEL_APP_ENV') !== 'production') {
                        $exceptionInfo = [
                            'exception_message' => $exception->getMessage(),
                            'file'              => $exception->getFile(),
                            'line'              => $exception->getLine(),
                            'trace'             => $exception->getTrace(),
                        ];
                        $exceptionContent = array_merge(
                            $exceptionContent,
                            $exceptionInfo
                        );
                    }

                    return response()->json($exceptionContent, 400);
                }
            }
        );
    })->create();
