<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\DeclerationDate;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;

class DeclerationDateController extends Controller
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

        $id = Crypt::decrypt($request->modal_id);

        DeclerationDate::createDecDate($id);
        UserActivity::createActivity('<span class="text-primary"> Create New Date For Customer <span>' );
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeclerationDate  $declerationDate
     * @return \Illuminate\Http\Response
     */
    public function show(DeclerationDate $declerationDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeclerationDate  $declerationDate
     * @return \Illuminate\Http\Response
     */
    public function edit(DeclerationDate $declerationDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeclerationDate  $declerationDate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeclerationDate $declerationDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeclerationDate  $declerationDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeclerationDate $declerationDate)
    {
        //
    }
}
