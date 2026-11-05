<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CasinoController extends Controller
{
    public function index() {
        return view('casino');
    }

    public function updateBalance(Request $request) {
        $request->validate([
            'amount' => ['required', 'integer']
        ]);

        $user = auth()->user();
        
        if ($user->balance + $request->amount < 0) {
            return response()->json(['success' => false, 'message' => 'Saldo insuficiente', 'balance' => $user->balance]);
        }

        $user->balance += $request->amount;
        $user->save();

        return response()->json(['success' => true, 'balance' => $user->balance]);
    }
}