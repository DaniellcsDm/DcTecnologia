<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
 
    use ResetsPasswords;

    protected $redirectTo = '/login'; // Redireciona para a página de login após a redefinição de senha

    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
}
