<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReFill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    public function reFill(ReFill $reFill)
    {
        try {
            DB::beginTransaction();

                $user = Auth::user();
                $user->increment('wallet_total_refilled', $reFill->get('amount'));
                $user->increment('wallet_balance', $reFill->get('amount'));

                $user->analytics()->create([
                    'amount' => $reFill->get('amount'),
                    'action' => 'refill'
                ]);

            DB::commit();

            return response()->json([
               'status' => 'success'
            ]);

        } catch (\Throwable $e) {
            DB::rollback();
        }
    }

    public function history()
    {
        $user = Auth::user();

        return response()->json([
            'wallet_balance' => $user->wallet_balance,
            'wallet_total_refilled' => $user->wallet_total_refilled,
            'wallet_total_withdrawn' => $user->wallet_total_withdrawn,
            'analytics' => $user->analytics
        ]);
    }
}
