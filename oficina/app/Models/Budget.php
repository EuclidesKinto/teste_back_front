<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Budget extends Model
{
    use HasFactory;
    protected $fillable =['client', 'description', 'price', 'seller_id'];

    public function seller(): HasOne
    {
        return $this->HasOne(Seller::class);
    }
}
