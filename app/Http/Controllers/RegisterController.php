<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegisterController extends Controller
{
    public function index()
    {

        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            abort(404, 'Opa, você não tem permissão para executar esta ação.');
        }
        session(['page' => 'registers']);
        return view('register.show');
    }
}
