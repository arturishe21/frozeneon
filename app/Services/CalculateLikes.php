<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CalculateLikes
{
   public function handle(Model $model)
   {
       $user = Auth::user();

       if ($user->likes_balance == 0) {
           return response()->json([
               'status' => 'error',
               'message' => 'balance of likes is empty'
           ]);
       }

       $model->increment('likes');
       $user->decrement('likes_balance');

       return response()->json([
           'status' => 'success',
           'likes' => $model->refresh()->likes,
           'user' => $user->refresh()
       ]);

   }
}