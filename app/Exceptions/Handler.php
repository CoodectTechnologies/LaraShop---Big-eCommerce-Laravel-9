<?php

namespace App\Exceptions;

use Illuminate\Encryption\MissingAppKeyException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if(!file_exists(base_path('.env'))):
            if($exception instanceof MissingAppKeyException):
                copy(base_path('.env.example'), base_path('.env'));
                return Redirect::route('install.general.index');
            endif;
        endif;
        return parent::render($request, $exception);
    }
}
