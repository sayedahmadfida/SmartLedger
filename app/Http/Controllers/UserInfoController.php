<?php

namespace App\Http\Controllers;

use App\Models\User_info;
use App\Models\UserAvatar;
use Illuminate\Http\Request;
use App\Http\Requests\UsersInfoRequest;
use App\Utils\UserDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\AllPhone;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAvatar = UserAvatar::where('user_id', Auth::id())->get();
        
        $invoicePhone = AllPhone::where('all_id', Auth::id())
        ->where('all_type', 'INVOICE')
        ->select('id', 'all_phone')
        ->get();

        $userInfo = user_info::where('user_id', Auth::id())->get();
        
        $countries = UserDetails::countriesList();
        return view('pages.users.usersInfo.create', compact('countries','userInfo','invoicePhone','userAvatar'));
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
    public function store(UsersInfoRequest $request)
    {
        user_info::createUserInfo($request->all());
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_info  $user_info
     * @return \Illuminate\Http\Response
     */
    public function show(User_info $user_info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User_info  $user_info
     * @return \Illuminate\Http\Response
     */
    public function edit(User_info $user_info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User_info  $user_info
     * @return \Illuminate\Http\Response
     */
    public function update(UsersInfoRequest $request,  $userid)
    {
        user_info::updateUserInfo($request->all(), $userid);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_info  $user_info
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_info $user_info)
    {
        //
    }
}
