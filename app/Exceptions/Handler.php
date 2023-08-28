<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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
    }


    public function render($request, Exception|Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Entry for '.str_replace('App', '', $exception->getModel()).' not found'
            ], 404);
        }

        return parent::render($request, $exception);
    }


//    public function handleException(\Exception $exception)
//    {
//        if ($exception instanceof RouteNotFoundException) {
//            return new JsonResponse(['error' => 'Route not found'], 404);
//        }
//
//        // Handle other exceptions here if needed
//
//        return parent::render($request, $exception);
//    }
}
