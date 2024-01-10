<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Models\User;
use App\Utils\UserDetails;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequset;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase_invoice_paid;
use Illuminate\Support\Facades\Crypt;
use App\Services\UserManagementServices;


class UserManagementController extends Controller
{

    protected $userDetails;

    private UserManagementServices $userManagementServices;
    /**
     * Constructor
     *
     * @param UserDetails $userDetails
     * @return void
     */
    public function __construct(UserDetails $userDetails,UserManagementServices $userManagementServices)
    {
        $this->userDetails = $userDetails;
        $this->userManagementServices = $userManagementServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    public function index()
    {
        if (!auth()->user()->can('user.view')) {
                abort(403, 'Your Are Unauthorized!');
        }
        
            $users = User::where('admin_id', session('user.admin_id'))
            ->where('type', '!=' ,'ADMIN')
            ->select(['id', 'type', 'f_name', 'l_name', 'email', 'username','status', 'created_at'])->get();

        return view('pages.manage_users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('user.create')) {
            abort(403, 'Your Are Unauthorized!');
        }

        return view('pages.manage_users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_count = $this->userDetails->checkUsername($request->username);
        $email_count = $this->userDetails->checkEmail($request->email);
        
        if ($email_count != 0) {
        
            return back()->withErrors(['email' => 'Email already exist']);
        
        } elseif ($user_count != 0) {
        
            return back()->withErrors(['username' => 'Username already exist']);
        
        } else {

            $userDTO = new UserDTO($request);
            $user = $this->userManagementServices->createUser($userDTO);    
     
            UserActivity::createActivity('Add new user <span class="text-primary"> ('. $request->first_name .') <span>' );
            return redirect()->route('users.index');
        }
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
        $user = User::where('admin_id', session('user.admin_id'))->where('id', $id)->get()[0];
        return view('pages.manage_users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('user.update')) {
            abort(403, 'Your Are Unauthorized!');
        }

        try {
            $user_data = $request->only(['first_name', 'last_name']);
            $user_data['user_id'] = $id;
           
                $user = User::findOrFail($id);
                $user->updateUser($user_data, $user);
                UserActivity::createActivity('Update user <span class="text-danger"> ('. $request->first_name .') <span>' );
                return redirect()->route('users.index');
        } catch (\Throwable $th) {
            dd($th);
        }

           

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        try {
            $decrypted = Crypt::decrypt($user);
            $users = User::findOrFail($decrypted);
            $users->delete();
            return redirect()->back();
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            dd($e);
        }
    }

    /**
     * Handles the validation username
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckUsername(Request $request)
    {
        $user_count = $this->userDetails->checkUsername($request->username);
        if ($user_count == 0) {
            echo "true";
            exit;
        } else {
            echo "false";
            exit;
        }
    }

    /**
     * Handles the validation email
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckEmail(Request $request)
    {
        $email_count = $this->userDetails->checkEmail($request->email);
        if ($email_count == 0) {
            echo "true";
            exit;
        } else {
            echo "false";
            exit;
        }
    }


    public function userAction(Request $request){
        $id = Crypt::decrypt($request->id);

        $type = $request->type === 'DISABLE' ? 0 : 1;
        
        $data = $this->userManagementServices->userStatus($id, $type);
        
        $msg = $type == 0 ? 'Disabled' : 'Activated';
        UserActivity::createActivity('<span class="text-danger"> Set User Status  <span>' );
        return [
            'type' => $type,
            'status' => $data,
            'msg' => 'User Successfully '. $msg
        ];

    }
}
