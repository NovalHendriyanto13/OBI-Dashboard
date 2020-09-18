<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        $statusCode = $exception->getStatusCode();
        $errors = [
            401 => [
                'image'=>'401.png',
                'title'=>'401 | Unauthorized',
                'label'=>[
                    'head'=>'You dont have authorized to access the page',
                    'description'=>''
                ],
            ],
            404 => [
                'image'=>'404.png',
                'title'=>'404 | Page Not Found',
                'label'=>[
                    'head'=>"Oopps. The page you were looking for doesn't exist",
                    'description'=>'You may have mistyped the address or the page may have moved. Try searching below.'
                ],
            ],
        ];

        $data = [
            'error'=>$errors[$statusCode]
        ];
        return response()->view('errors.custom', $data);
        
        // return parent::render($request, $exception);
    }
}
