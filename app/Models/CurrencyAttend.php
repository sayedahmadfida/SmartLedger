<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyAttend extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'is_default',
        'user_id',
        'admin_id'
    ];
}
