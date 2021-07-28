<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);

        inertia()->setRootView('account::app');

        if (in_array($response->status(), [404, 403])) {
            return inertia()
                ->render('Error/Error404', [
                    'status' => $response->status(),
                    'message' => $response->status() === 404 ? 'Страница не найдена.' : 'Доступ запрещен.',
                    'metaInfo' => ['title' => $response->status()]
                ])
                ->toResponse($request)
                ->setStatusCode($response->status());
        }

        if (app()->environment('production') && in_array($response->status(), [500, 503])) {
            return inertia()
                ->render('Error/Error500', [
                    'status' => $response->status(),
                    'message' => ucfirst($e->getMessage())
                ])
                ->toResponse($request)
                ->setStatusCode($response->status());
        }

        if ($response->status() === 419) {
            return inertia()->location($request->getRequestUri());
        }

        if ($e instanceof ThrottleRequestsException) {
            $seconds = $e->getHeaders()['Retry-After'];

            return back()->with('flash', [
                'type' => 'throttle',
                'text' => trans('errors.throttle'),
                'icon' => 'warning',
                'timer' => $seconds * 1000
            ]);
        }

        return $response;
    }
}
