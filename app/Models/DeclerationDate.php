<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeclerationDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'currency_id',
        'user_id',
        'admin_id'
    ];

    public static function createDecDate($modelId){
        return DeclerationDate::create([
            'model_id' => $modelId,
            'currency_id' => session('user.currency_id'),
            'user_id' => session('user.id'),
            'admin_id' => session('user.admin_id')
        ]);
    }
}
