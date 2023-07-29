<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (\Throwable $e) {
            $message = $e->getMessage()."\n";
            $message .= $e->getFile()."\n";
            $message .= $e->getLine()."\n";
            $message .= print_r($e->getTrace(), true)."\n";
            $message .= request()->url()."\n";
            $message .= print_r(request()->all(), true)."\n";
            $message .= request()->ip()."\n";

            \Mail::raw($message, function ($m) {
                $m->to('dave@coderstudios.com', 'dave@coderstudios.com')->subject(config('app.name').' - Error');
            });
        });
    }
}
