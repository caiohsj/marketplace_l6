<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $this->getPagseguroSessionCode();
        return view('checkout');
    }

    public function proccess(Request $request)
    {
        dd($request->all());
    }

    private function getPagseguroSessionCode()
    {
        if (!session()->has('pagseguroSessionCode')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
           return session()->put('pagseguroSessionCode', $sessionCode->getResult());
        }
    }
}
