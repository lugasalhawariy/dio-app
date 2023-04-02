<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UuidTraits;

    protected $guarded = ['id'];

    public $with = ['inventory'];

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
}
