<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Customer;
use App\Utils\UserDetails;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\DeclerationDate;
use App\Services\CustomerServices;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{

    protected $userDetails;
    protected $businessServices;
    /**
     * Constructor
     *
     * @param UserDetails $userDetails
     * @return void
     */
    public function __construct(UserDetails $userDetails, CustomerServices $businessServices)
    {
        $this->userDetails = $userDetails;
        $this->businessServices = $businessServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if (!auth()->user()->can('customer.view')) {
           return redirect()->back();
        }
        
        

        $countries = UserDetails::countriesList();
        if ($request->ajax()) {
        $customers = Customer::where('admin_id', session('user.admin_id'))
            ->withTrashed()
            ->select([
                'id', 'customer_name',
                DB::raw("CONCAT(customer_country,' ', customer_province,' ', customer_state) as address "),
                'identity_card', 'created_at', 'deleted_at'
            ])->orderBy('deleted_at', 'ASC');
            
            return DataTables::of($customers)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return substr($row->created_at, 0, 10);
                })
                ->filterColumn('address', function ($query, $keyword) {
                    $keywords = trim($keyword);
                    $query->whereRaw("CONCAT(customer_country,' ', customer_province,' ', customer_state) like ? ", ["%{$keywords}%"]);
                })
                ->editColumn('status', function($row){
                    return $row->deleted_at == NULL ? '<span class="badge bg-green">Active</span>' : '<span class="badge bg-red">Disabled</span>';
               
                })
                ->addColumn(
                    'action',
                    function ($row) {
                       
                        $delete = auth()->user()->can('customer.delete') == true ? 
                            ' <li>
                                <a href="#"  onclick="deleteCustomer(event)"  data-id="' . Crypt::encrypt($row->id) . '"><i class="fa fa-trash text-danger" aria-hidden="true"></i>Delete</a>
                            </li>' 
                            : NULL ;
                       
                       
                            $active = auth()->user()->can('customer.delete') == true ? 
                            ' <li>
                                <a href="#"  onclick="deleteCustomer(event)"data-type="ACTIVE"  data-id="' . Crypt::encrypt($row->id) . '">
                                <i class="fa-regular fa-circle-check"></i> Active</a> 
                                </li>' 
                            : NULL ;
                       

                            $edit = auth()->user()->can('customer.update') == true ? 
                            '<li>
                                <a href="' . route("customer.edit",  Crypt::encrypt($row->id)) . '" class="pay_purchase_due"><i class="fa fa-pencil-square text-success" aria-hidden="true"></i>Edit</a>
                            </li>' 
                            : NULL ;
                    
                        $action =

                            $row->deleted_at == NULL ?
                            '<div class="btn-group">
                                <a href="javascript:void(0)" class="btn-primary btn btn-xs dropdown-toggle"  aria-expanded="false" data-toggle="dropdown">
                                    <span>Action <i class="fa-solid fa-caret-down"></i></span>
                                </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a role="menuitem" tabindex="-1" href="#" onclick="setModelId(event)"
                                                data-id="' . Crypt::encrypt( $row->id ) . '"  data-toggle="modal" data-target="#transaction-model"p> <i class="fa-regular fa-money-bill-1 text-info"></i>Transaction
                                            </a>
                                        </li>
                                        <li>
                                            <a href="' . route("customer.show", Crypt::encrypt($row->id)) . '" class="pay_purchase_due"><i class="fa fa-external-link text-primary" aria-hidden="true"></i>View</a>
                                        </li>
                                          '.$edit.' '.$delete.'
                                       
                                    </ul>
                                </div>' : 
                                '<div class="btn-group">
                                    <a href="javascript:void(0)" class="btn-primary btn btn-xs dropdown-toggle"  aria-expanded="false" data-toggle="dropdown">
                                        <span>Action <i class="fa-solid fa-caret-down"></i></span>
                                    </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                            <a role="menuitem" tabindex="-1" href="#" onclick="setModelId(event)"
                                            data-id="' .Crypt::encrypt( $row->id ). '"  data-toggle="modal" data-target="#transaction-model"p> <i class="fa-regular fa-money-bill-1 text-info"></i>Transaction
                                        </a>
                                            </li>
                                            <li>
                                                <a href="' . route("customer.show", Crypt::encrypt($row->id)) . '" class="pay_purchase_due"><i class="fa fa-external-link text-primary" aria-hidden="true"></i>View</a>
                                            </li>
                                              '.$edit.' '.$active.'
                                           
                                        </ul>
                                    </div>';
                        return $action;
                    }
                )
                ->rawColumns(['action', 'status'])
                ->removeColumn('id')
                ->make(true);
        }
        return view('pages.contacts.customer.index', compact('countries'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = UserDetails::countriesList();
        return view('pages.contacts.customer.create', compact('countries'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (!auth()->user()->can('customer.create')) {
            abort(403, 'Your Are Unauthorized!');
        }

        try{
            
            DB::beginTransaction();

            $customer = Customer::createCustomer($request);
            
            $phone = Phone::createPhone($request->phone, $customer->id);        
            DeclerationDate::createDecDate($customer->id);
            
            UserActivity::createActivity('Added new customer ( '.$customer->customer_name . ' )');

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $id = Crypt::decrypt($id);

        

        $decDateId = DeclerationDate::where('model_id', $id)->latest()->first()->id;
        $ledgerAccount = DB::select('SELECT transactions.*, @balance := @balance + IF(transiction_type = "CREDIT", credit_amount, - debit_amount) AS remainder FROM transactions CROSS JOIN (SELECT @balance := 0) AS b WHERE model_id = '.$id.' AND decleration_date_id = '.$decDateId.' ORDER BY id ASC');
        
        
        $countries = UserDetails::countriesList();
        
        $sumData = DB::table('transactions')
            ->selectRaw('sum(credit_amount) AS credit, sum(debit_amount) AS debit')
            ->where('model_id', $id)
            ->where('decleration_date_id' , $decDateId)
            ->first();

        $customer = Customer::where('id', $id)->withTrashed()->first();
        
        $customerPhone = Phone::where('model_id', $id)->where('user_id', session('user.id'))->get();
       
        return view('pages.contacts.customer.show', compact(
            'customerPhone', 
            'customer', 
            'ledgerAccount',
            'sumData',
            'countries'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('customer.update')) {
            abort(403, 'Your Are Unauthorized!');
        }

        $id = Crypt::decrypt($id);
        $countries = UserDetails::countriesList();
        $customer = Customer::where('id', $id)
        ->where('admin_id', session('user.admin_id'))->withTrashed()->first();

        return view('pages.contacts.customer.edit', compact('customer', 'countries'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if (!auth()->user()->can('customer.update')) {
            abort(403, 'Your Are Unauthorized!');
        }

        Customer::customerUpdate($request, Crypt::decrypt($id));
        UserActivity::createActivity('<span class="text-success"> Update Customer '. $request->name .' <span>' );
        
        
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $id = Crypt::decrypt($id);
        $record = Customer::where('id',$id)->withTrashed()->first();
        UserActivity::createActivity('<span class="text-danger"> Change Customer Status '. $record->customer_name .' <span>' );
        return $record->deleted_at == NULL ?  $record->delete()  : $record->restore() ;

    }




    public function make_credit($customers)
    {
        return $customer;
        $sale_invoice_paid = json_decode(json_encode(array('customer_id' => $customers)));

        $money_resources = $this->userDetails->moneyResourcesForDropdown();

        $invoice_total = 0.0;
        return view('pages.contacts.customer.partials.make-credit', compact('sale_invoice_paid', 'money_resources', 'invoice_total'));
    }
    

    public function payment_data(Request $request, $customers)
    {
        $customer = Crypt::decrypt($customers);
        if ($request->ajax()) {
            $sale_invoice_paid = Customer_invoice_paid::where('customer_invoice_paids.customer_id', $customer)
                ->where('customer_invoice_paids.paid_type', 'DEBIT')
                ->join('money_resourses as mr', 'mr.id', '=', 'customer_invoice_paids.money_resources_id')
                ->select(['customer_invoice_paids.id', 'paid_amount', 'paid_description', 'customer_invoice_paids.created_at', 'mr.resourse_type', 'mr.resourse_name'])
                ->get();

            return DataTables::of($sale_invoice_paid)
                ->editColumn('created_at', function ($row) {
                    return substr($row->created_at, 0, 10);
                })
                ->editColumn('paid_amount', function ($row) {
                    return session('user.currency_symbol') . ' ' . number_format($row->paid_amount);
                })
                ->addColumn('paid_in', function ($row) {
                    return $row->resourse_type . ' ' . $row->resourse_name;
                })
                ->addColumn(
                    'action',
                    '<div class="row">
                    <button type="button" class="btn btn-primary btn-xs edit_sale_paid"
                    data-container=".show_modal"
                    data-url="{{ route("customer.editCustomerPayment",$id) }}"><i
                        class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-danger btn-xs delete_sale_paid"
                                            data-url="{{ route("sales-paid.destroy", $id) }}"><i
                                                class="fa fa-trash-o"></i></button>
                    </div>'
                )
                ->removeColumn('id')
                ->make(true);
        }
    }








}
