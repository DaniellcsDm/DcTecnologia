<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirecionamento após o login
    protected function redirectTo()
    {
        return route('vendas.index'); // Certifique-se de que 'vendas.index' é a rota nomeada correta.
    }
}
