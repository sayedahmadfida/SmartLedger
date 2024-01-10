<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->ajax()){

            $userData = UserActivity::where('admin_id', session('user.admin_id'))
            ->select('id', 'full_name', 'activity_description', 'created_at')
            ->orderBy('id', 'DESC');
            
            return DataTables::of($userData)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return substr($row->created_at, 0, 10);
                })
                ->editColumn('full_name', function ($row) {
                    return $row->full_name;
                })
                ->addColumn('activity_description', function ($row) {
                    return $row->activity_description;
                })
                ->rawColumns(['action', 'activity_description'])
                ->removeColumn('id')
                ->make(true);
            }

        return view('pages.user-activity.index');
    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function show(UserActivity $userActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(UserActivity $userActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserActivity $userActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserActivity  $userActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserActivity $userActivity)
    {
        //
    }
}
