<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function render($request, Exception $e)
    {
        if ($e instanceof TokenMismatchException) {
            return redirect()
                ->back()
                ->withInput($request->except('password', '_token'))
                ->withError('Validation Token has expired. Please try again');
        }

        return parent::render($request, $e);
    }
}
