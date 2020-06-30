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
        $total = 0;
        $cartSubTotalItems = array_map(function ($row) {
            return $row['price'] * $row['amount'];
        }, session()->get('cart'));
        $total = array_sum($cartSubTotalItems);
        return view('checkout', compact('total'));
    }

    public function proccess(Request $request)
    {
        $dataPost = $request->all();
        //Instantiate a new direct payment request, using Credit Card
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

        // Set a reference code for this payment request. It is useful to identify this payment
        // in future notifications.

        // Set the currency
        $creditCard->setCurrency("BRL");

        $creditCard->setReference("REF01");

        $cartItems = session()->get('cart');

        foreach ($cartItems as $item) {
            // Add an item for this payment request
            $creditCard->addItems()->withParameters(
                'REF01',
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }

        $user = auth()->user();

        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        // Set your customer information.
        // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br
        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);

        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '64311869070'
        );

        $creditCard->setSender()->setHash($dataPost['hash']);

        $creditCard->setSender()->setIp('127.0.0.0');

        // Set shipping information for this payment request
        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        //Set billing information for credit card
        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        // Set credit card token
        $creditCard->setToken($dataPost['cardToken']);

        $installment = explode('|', $dataPost['installment']);

        // Set the installment quantity and value (could be obtained using the Installments
        // service, that have an example here in \public\getInstallments.php)
        $creditCard->setInstallment()->withParameters($installment[0], number_format($installment[1], 2, '.', ''));

        // Set the credit card holder information
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($dataPost['cardName']); // Equals in Credit Card

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '64311869070'
        );

        // Set the Payment Mode for this payment request
        $creditCard->setMode('DEFAULT');

        //Get the crendentials and register the credit card payment
        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        var_dump($result);
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
