<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        /* 自定义错误页面 */
        if ($exception instanceof HttpException
            || $exception instanceof \ErrorException // 服务器内部错误
        ) {
            if ($exception instanceof \ErrorException) {
                // 服务器内部错误
                $statusCode = 500;
            } else {
                $statusCode = $exception->getStatusCode();
            }
            $message  = $exception->getMessage();
            // 针对app端接口返回json对象
            // 注：请求头必须加上 Accept:application/json
            if ($request->wantsJson()) {
                return result($statusCode, null, $message);
            }
            if (view()->exists('errors.' . $statusCode)
//                && !\request()->routeIs('system_install')
                && request()->path() != 'install/seeder'
            ) {
                return response()->view('errors.' . $statusCode, ['message'=>$message, 'exception'=>$exception], $statusCode);
            }
        }

        return parent::render($request, $exception);
    }

    public function isValid($value)
    {
        try {

        } catch (\Exception $e){
            report($e);
            return false;
        }
    }

}
