<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Transaction;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\DeclerationDate;
use Illuminate\Support\Facades\Crypt;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $id = Crypt::decrypt($request->model_id);
        
        $decDateId = DeclerationDate::where('model_id', $id)->orderBy('id', 'DESC')->limit(1)->first()->id;
    
        Transaction::createTransiction(
            $id,
            $request->amount, 
            $request->type, 
            $request->transictionDescription, 

            $decDateId,
        );
        UserActivity::createActivity('<span class="text-primary"> Add New Transaction '. $request->amount .' <span>' );

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        $id = Crypt::decrypt($id);
        $transaction = Transaction::updateTrancistion($id, $request->amount, $request->type, $request->transactionDescription);
 
        UserActivity::createActivity('<span class="text-success"> Update Transaction '. $request->amount .' <span>' );

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::findOrFail(Crypt::decrypt($id))->delete();

        
        UserActivity::createActivity('<span class="text-danger"> Delete Transaction <span>' );

        return redirect()->back();
    }
}
