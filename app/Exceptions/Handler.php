<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        // log errors only in production mode and it's not http exception
        if (env('APP_ENV') == 'production' && !$this->isHttpException($exception)) {

            // parse html from response
            $exceptionHtml = $this->render(null, $exception)->getContent();

            Mail::to('webmaster@reydecibel.com.mx')->send(new \App\Mail\ExceptionOccured($exceptionHtml));
        }

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
        if($this->isHttpException($exception))
        {
            return $this->renderHttpException($exception);
        }
        // Check exception rendering - if env is production, we don't want to show exception, so we send errors/500.blade.php view
        else if (env('APP_ENV') == 'production' && $request != null) {
            if ($exception instanceof \ErrorException) {
                return response('Fatal Error!', 500);
            } else {
                return response()->view('errors.500', [], 500);
            }
        }
        else
        {
            return parent::render($request, $exception);
        }
    }
}
