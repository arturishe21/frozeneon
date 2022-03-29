<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boosterpack extends Model
{
    protected $guarded = [];

    public function getItemLikesUpdateBank()
    {
        $maxPrice = $this->bank + $this->price - $this->us;
        $item = Item::where('price', '<', $maxPrice)->get()->random();
        $newBank = $maxPrice - $item->price;

        $this->update(['bank' => $newBank]);

        return $item->price;
    }
}