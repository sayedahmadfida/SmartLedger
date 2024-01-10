<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'credit_amount',
        'debit_amount',
        'transiction_type',
        'transaction_description',
        'user_id',
        'admin_id',
        'decleration_date_id'
    ];

    public static function createTransiction($modelId, $amount, $transactionType, $transictionDescription,  $decDateId){
        $culumn = $transactionType == 'DEBIT' ? 'debit_amount' : 'credit_amount';
        
        return Transaction::create([
            'model_id' => $modelId,
            $culumn => $amount,
            'transiction_type' => $transactionType,
            'transaction_description' => $transictionDescription,
            'user_id' => session('user.id'),
            'admin_id' => session('user.admin_id'),
            'decleration_date_id' => $decDateId,
        ]);
    }


    public static function updateTrancistion($recordId, $amount, $transactionType, $transictionDescription){
            
        $culumn = $transactionType == 'DEBIT' ? 'debit_amount' : 'credit_amount';
        $reCulumn = $transactionType == 'DEBIT' ? 'credit_amount' : 'debit_amount';
        
        return Transaction::where('id', $recordId)->update([
            $culumn => $amount,
            $reCulumn => null,
            'transiction_type' => $transactionType,
            'transaction_description' => $transictionDescription,
        ]);
    }




}
