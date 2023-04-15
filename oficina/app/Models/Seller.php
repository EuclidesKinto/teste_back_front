<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function budgets(): HasMany
    {
        return $this->HasMany(Budget::class);
    }
}
