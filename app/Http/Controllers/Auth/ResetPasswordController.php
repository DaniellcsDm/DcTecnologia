<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login'; // Redireciona para a página de login após a redefinição de senha

    public function __construct()
    {
        $this->middleware('guest');
    }
}

