<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson() || starts_with($request->path(), 'api')) {
            return $this->apiExceptionRender($request, $exception);
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return redirect()->guest(route('login'));
    }

    protected  function apiExceptionRender($request, Exception $e) {
        $e = $this->prepareException($e);
        if ($e instanceof HttpResponseException) {
            return response()->json([
                'err_code' => $e->getCode().'',
                'err_msg' => $e->getMessage(),
            ]);
        } elseif ($e instanceof AuthenticationException) {
            return response()->json([
                'err_code' => '401',
                'err_msg' => 'Unauthenticated.' ,
            ]);
        } elseif ($e instanceof ValidationException) {
            $errors = $e->validator->errors()->getMessages();
            $flat_errors = [];
            foreach($errors as $err) {
                array_push($flat_errors, $err[0]);
            }
            return response()->json([
                'err_code' => '422',
                'err_msg' => implode(' ', $flat_errors)
            ]);
        }
        return response()->json([
            'err_code' => '400',
            'err_msg' => $e->getMessage(),
        ]);
    }
}
