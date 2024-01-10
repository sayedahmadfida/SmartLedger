<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PhoneController extends Controller
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

        Phone::createPhone($request->phone, Crypt::decrypt($request->model_id), Crypt::decrypt($request->model_type));
        
        UserActivity::createActivity('<span class="text-primary"> Create New Phone '.$request->phone.'<span>' );

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $phoneId)
    {
        Phone::updatePhone($request->phone, Crypt::decrypt($phoneId));
        UserActivity::createActivity('<span class="text-success">Update Phone Number '.$request->phone.'<span>' );
        return redirect()->back();
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy( $phone)
    {
        UserActivity::createActivity('<span class="text-danger"> Delete Phone Number <span>' );
        return Phone::findOrFail($phone)->delete();
    }
}
