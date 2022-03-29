<?php

namespace App\Http\Controllers;

use App\Models\Boosterpack;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BoosterpackController extends Controller
{
    public function buy(Boosterpack $boosterpack)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();

            if ($boosterpack->price > $user->wallet_balance) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Not enough money, you have to refill the balance'
                ]);
            }

            $likes = $boosterpack->getItemLikesUpdateBank();

            $user->decrement('wallet_balance', $boosterpack->price);
            $user->increment('wallet_total_withdrawn', $boosterpack->price);
            $user->increment('likes_balance', $likes);

            $user->analytics()->create([
                'amount' => $boosterpack->price,
                'action' => 'buy_boosterpack',
                'object' => 'boosterpack',
                'object_id' => $boosterpack->id
            ]);

            $user->analytics()->create([
                'amount' => $likes,
                'action' => 'add_likes',
                'object' => 'boosterpack',
                'object_id' => $boosterpack->id
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'user' => $user->refresh(),
                'likes' => $likes
            ]);

        } catch (\Throwable $e) {
            DB::rollback();
        }

    }
}
