<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\PagSeguro\CreditCard;

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
        try {
            $dataPost = $request->all();
            $reference = 'REF02';
            $cartItems = session()->get('cart');
            $user = auth()->user();
            
            $creditCard = new CreditCard($dataPost, $cartItems, $user, $reference);
            $result = $creditCard->makeCheckout();
            
            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                'store_id' => 1
            ];

            $user->orders()->create($userOrder);

            session()->forget('cart');
            session()->forget('pagseguroSessionCode');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso',
                    'order' => $reference
                ]
            ]);
        } catch(\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar';

            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
                ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
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
