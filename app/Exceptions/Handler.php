<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Google\Cloud\Core\Exception\BadRequestException;
use Google\Cloud\Core\Exception\NotFoundException;

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
        $duration =  microtime(true) - LARAVEL_START;
        if ($exception instanceof BadRequestException) {
            return response(['success' => 0, 'code' => 400, 'data' => [], 'errors' => ['message' => 'Invalid request', 'code' => 400002], 'duration' => $duration], 400);
        }
        if ($exception instanceof NotFoundHttpException) {
            if (str_contains(request()->url(), 'api')) {
                return response(['success' => 0, 'code' => 404, 'data' => [], 'errors' => ['message' => 'Incorect route', 'code' => 404005], 'duration' => $duration], 404);
            }
        }
        if ($exception instanceof ModelNotFoundException) {
            $modelName = class_basename($exception->getModel());
            $message = "Cannot find {$modelName}";
            return response(['success' => 0, 'code' => 404, 'data' => [], 'errors' => ['message' => 'Given Id was not found', 'code' => 404005], 'duration' => $duration], 404);
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response(['success' => 0, 'code' => 405, 'data' => [], 'errors' => ['message' => 'Method is not allowed', 'code' => 405], 'duration' => $duration], 405);
        }

        return parent::render($request, $exception);
    }
}
