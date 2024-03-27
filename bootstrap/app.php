<?php

use App\Http\Middleware\AuthorizeAdmin;
use App\src\Exceptions\CommonException;
use Exception as BaseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web:      __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health:   '/up',
    )
    // ->withRouting(
    //     api:    __DIR__ . '/../routes/api.php',
    //     health: '/up'
    // )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['permissions' => AuthorizeAdmin::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(
            function (BaseException $exception, Request $request) {
                report($exception);
                if (!$exception instanceof CommonException
                    && $request->expectsJson()
                ) {
                    if ($exception instanceof ModelNotFoundException) {
                        return \response()->json('Record Not Founded', 404);
                    }
                    $exceptionContent = [
                        'message'        => Lang::get(
                            'exceptions.exception_' . CommonException::DEFAULT_CODE
                        ),
                        'exception_code' => CommonException::DEFAULT_CODE,
                    ];
                    if (env('LARAVEL_APP_ENV') !== 'production') {
                        $exceptionInfo = [
                            'exception message' => $exception->getMessage(),
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
