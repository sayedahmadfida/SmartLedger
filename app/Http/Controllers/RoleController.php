<?php

namespace App\Http\Controllers;

use App\Utils\Util;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    private $permissions = [];
    private $util;
    /**
     * Constructor
     *
     * @param Util $util
     * @return void
     */
    public function __construct(Util $util)
    {
        $this->util = $util;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('user.view')) {
            abort(403, 'Your Are Unauthorized!');
        }

        $users = User::where('admin_id',session('user.admin_id'))->get();
        
        return view('pages.Roles.index', compact('users'));
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
    public function store(RoleRequest $request)
    {
        if (!auth()->user()->can('user.create')) {
            abort(403, 'Your Are Unauthorized!');
        }
        $user = User::find($request->user_id);
        $user->givePermissionTo($request->permession);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Your Are Unauthorized!');
        }
        $user = User::findOrFail($id);
        $this->permissions = $this->util->getPermissions($user, $this->permissions);
        return view('pages.Roles.edit', ['permissions' => $this->permissions, 'user' => $user]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Your Are Unauthorized!');
        }
        
        $user = User::findOrFail($id);
        $this->permissions = $this->util->getPermissions($user, $this->permissions);
        $user->revokePermissionTo($this->permissions);
        $user->givePermissionTo($request->permession);
        UserActivity::createActivity('<span class="text-danger"> Set User Permission  <span>' );
            
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
