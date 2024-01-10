<?php

namespace App\Http\Controllers;

use App\Utils\UserDetails;
use Illuminate\Http\Request;
use App\Models\CurrencyAttend;
use Yajra\DataTables\Facades\DataTables;

class CurrencyAttendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currencies = CurrencyAttend::where('admin_id', session('user.admin_id'))->join('currencies', 'currency_attends.currency_id', '=', 'currencies.id')
            ->select(['currency_attends.id', 'currency_attends.currency_id', 'country', 'currency', 'code', 'symbol', 'is_default'])->orderBy('is_default', 'desc')->get();
     
            if ($request->ajax()) {
            return DataTables::of($currencies)
                ->addIndexColumn()
                ->addColumn('is_default', function ($row) {
                    if ($row->is_default === 0) {
                        $route = route('currency.default', $row->id);
                        return '<button data-url="' . $route . '" class="btn btn-primary btn-xs default-currency" >Make Default</i></button>';
                    } else {
                        return '<span class="badge bg-green">Default</span>';
                    }
                })
                ->addColumn('action', ' <div class="">
                    <button data-url="{{route("currency.edit", $id)}}" class="btn btn-success btn-xs currency_edit_id" ><i class="fa fa-pencil"></i></button>
                </div>')
                ->escapeColumns(['default'])
                ->removeColumn('id')
                ->make(true);
        }
        $currencies = UserDetails::allCurrencies();
        return view('pages.settings.currency.index', compact('currencies'));
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
     * @param  \App\Models\CurrencyAttend  $currencyAttend
     * @return \Illuminate\Http\Response
     */
    public function show(CurrencyAttend $currencyAttend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CurrencyAttend  $currencyAttend
     * @return \Illuminate\Http\Response
     */
    public function edit(CurrencyAttend $currencyAttend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CurrencyAttend  $currencyAttend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CurrencyAttend $currencyAttend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CurrencyAttend  $currencyAttend
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurrencyAttend $currencyAttend)
    {
        //
    }
}
