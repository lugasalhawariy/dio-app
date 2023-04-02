<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, UuidTraits;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            foreach(json_decode($sale->cart) as $item) {
                $sale->total_price += $item->price;

                foreach(json_decode($item->variants) as $variant) {
                    $sale->total_price += $variant->additional_price;
                }
            }
        });
    }
}
