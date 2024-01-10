<?php

namespace App\Utils;

use File;
use Storage;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Sale_invoice;
use App\Models\Sale_product;
use App\Models\MoneyResourses;
use App\Models\PaymentDetails;
use App\Models\Money_resourses;
use App\Models\Product_details;
use App\Models\Product_expenses;
use App\Models\Purchase_invoice;
use Illuminate\Support\Facades\DB;
use App\Models\Customer_invoice_paid;
use App\Models\Product_expenses_type;
use App\Models\Purchase_invoice_paid;

class UserDetails
{

    /**
     * Check the User username is exist or not
     *
     * @return Users counts
     */
    public function checkUsername($username)
    {
        $count = User::where('username', $username)->count();
        return $count;
    }

    /**
     * Check the User Email Address is exist or not
     *
     * @return Users Email counts
     */
    public function checkEmail($email)
    {
        $count = User::where('email', $email)->count();
        return $count;
    }

    public static function countriesList()
    {


        $countries = file_get_contents(public_path('json/countries.json')); 
        $country = json_decode($countries);

        return $country;
    }

    public static function allCurrencies()
    {
        $currencies = Currency::select('id', DB::raw("concat(country, ' - ',currency, '(', code, ') ') as info"))->orderBy('country')->get('info');
        return $currencies;
    }

    public function curreciesForDropDown()
    {
        // return Currency_attend::where('user_id', auth()->user()->id)
        return auth()->user()->currencies()->where('admin_id', session('user.admin_id'))
            ->join('currencies', 'currency_attends.currency_id', '=', 'currencies.id')
            ->select(['currency_attends.id as id', 'currency', 'code', 'symbol'])
            ->orderBy('is_default', 'desc')->get();
    }

    public function unitsForDropDown()
    {
        return auth()->user()->units()->get();
    }

    public function sub_categoriesForDropDown()
    {
        return Category::join('sub_categories', 'categories.id', '=', 'sub_categories.category_id')
            ->select(['sub_categories.id as id', 'categories.category_name', 'sub_categories.sub_category_name'])
            ->get();
    }

    public function product_companies()
    {
        return Company::where('user_id', auth()->user()->id)
            ->where('admin_id', session('user.admin_id'))
            ->select(['company_name', 'id'])
            ->get();
    }

    public function moneyResourcesForDropdown()
    {
        return MoneyResourses::where('money_resourses.user_id', auth()->user()->id)
            ->leftJoin('money_resourse_details as mrd', 'mrd.money_resources_id', '=', 'money_resourses.id')
            ->select(['money_resourses.id', 'resourse_type', 'resourse_name'])->get();
    }

    public function purchase_invoice_total($invoice_id)
    {
        return Purchase_invoice::where('purchase_invoices.id', $invoice_id)
            ->select([
                'total',
                // 'product_details.discounted_amount',
                DB::raw("(SELECT SUM(prd.discounted_amount) FROM product_details prd 
                WHERE prd.invoice_id = purchase_invoices.id AND deleted_at IS NULL) as discounted_amount"),
                DB::raw("(SELECT SUM(pip.paid_amount) FROM purchase_invoice_paids pip 
            WHERE pip.purchase_invoice_id = purchase_invoices.id  
            AND pip.paid_type = 'DEBIT') as total_paid"),
            ])
            ->first();
    }
    public function purchase_invoice_grand_total($purchase_invoice)
    {
        return Product_details::where('invoice_id', $purchase_invoice)
            ->join('currency_attends', 'product_details.currency_id', '=', 'currency_attends.id')
            ->join('currencies', 'currency_attends.currency_id', '=', 'currencies.id')
            ->selectRaw('currencies.symbol, currencies.code ,SUM(product_details.grand_total) as grand_total')
            ->groupBy('product_details.currency_id')->first();
    }

    public function sold_products_by_id(array $where, array $select)
    {
        // return Sale_product::from('sale_products as sale_products')
        //     ->join('products as pro', 'pro.id', '=', 'sale_products.product_id')
        //     ->join('units', 'units.id', '=', 'unite_id')
        //     ->join('sub_categories as scat', 'scat.id', '=', 'pro.sub_category_id')
        //     ->join('warehouses', 'warehouses.id', '=', 'sale_products.warehouse_id')
        //     ->join('currency_attends', 'currency_attends.id', '=', 'sale_products.currency_id')
        //     ->join('currencies as cur', 'cur.id', '=', 'currency_attends.currency_id')
        //     ->select($select)
        //     ->where($where)
        //     ->orderBy('sale_products.id', 'DESC');
    }
    public function sold_products_trashed_by_id(array $where, array $select)
    {
        return Sale_product::onlyTrashed()
            ->join('products as pro', 'pro.id', '=', 'sale_products.product_id')
            ->join('units', 'units.id', '=', 'unite_id')
            ->join('sub_categories as scat', 'scat.id', '=', 'pro.sub_category_id')
            ->join('warehouses', 'warehouses.id', '=', 'sale_products.warehouse_id')
            ->join('currency_attends', 'currency_attends.id', '=', 'sale_products.currency_id')
            ->join('currencies as cur', 'cur.id', '=', 'currency_attends.currency_id')
            ->select($select)
            // ->where('sale_products.deleted_at', 'null')
            ->where($where);
    }

    public function sale_invoice_total($invoice_id)
    {
        return Sale_invoice::where('sale_invoices.id', $invoice_id)
            ->leftJoin('customer_invoice_paids', 'customer_invoice_paids.sale_invoice_id', '=', 'sale_invoices.id')
            // ->join('currency_attends', 'sale_invoices.currency_id', '=', 'currency_attends.id')
            // ->join('currencies', 'currency_attends.currency_id', '=', 'currencies.id')
            ->select([
                // 'currencies.symbol',
                'total_amount',
                DB::raw("(SELECT SUM(sp.discounted_amount) FROM sale_products sp 
                WHERE sp.invoice_id = sale_invoices.id AND sp.deleted_at IS NULL) as discounted_amount"),
                DB::raw("(SELECT SUM(cip.paid_amount) FROM customer_invoice_paids cip 
                WHERE cip.sale_invoice_id = sale_invoices.id  
                AND cip.paid_type = 'DEBIT' AND cip.deleted_at IS NULL) as total_paid"),
                // DB::raw('( total_amount - SUM(paid_amount)) as total')
            ])
            ->groupBy('sale_invoices.id')->first();

        // return Purchase_invoice::where('purchase_invoices.id', $invoice_id)
        // ->select([
        //     'total',
        //     DB::raw("(SELECT SUM(pip.paid_amount) FROM purchase_invoice_paids pip 
        //     WHERE pip.purchase_invoice_id = purchase_invoices.id  
        //     AND pip.paid_type = 'DEBIT') as total_paid"),
        // ])
        // ->groupBy('purchase_invoices.id')->first();
    }

    public function editCustomerPayment($customer)
    {
        $totalSaleInvoices = Sale_invoice::where('user_id', auth()->user()->id)
            ->where('customer_id', $customer)
            ->where('currency_id', session('user.currency_id'))
            ->sum('total_amount');

        $totalCredits = Customer_invoice_paid::where('user_id', auth()->user()->id)
            ->where('customer_id', $customer)
            ->where('paid_type', 'CREDIT')
            ->where('currency_id', session('user.currency_id'))
            ->sum('paid_amount');

        $totalInvoicesPaids = Customer_invoice_paid::where('user_id', auth()->user()->id)
            ->where('customer_id', $customer)
            ->where('paid_type', 'DEBIT')
            ->where('currency_id', session('user.currency_id'))
            ->sum('paid_amount');

        $total = $totalSaleInvoices + $totalCredits;
        return [
            'total_paid' => $totalInvoicesPaids,
            'total_amount' => $totalSaleInvoices,
            'total' => $total - $totalInvoicesPaids,
        ];
    }

    public function editLTDPayment($ltd)
    {
        $totalPurchaseInvoices = Purchase_invoice::where('user_id', auth()->user()->id)
            ->where('ltd_id', $ltd)
            ->where('currency_id', session('user.currency_id'))
            ->sum('total');

        $totalCredits = Purchase_invoice_paid::where('user_id', auth()->user()->id)
            ->where('ltd_id', $ltd)
            ->where('paid_type', 'CREDIT')
            ->where('currency_id', session('user.currency_id'))
            ->sum('paid_amount');


        $totalInvoicesPaids = Purchase_invoice_paid::where('user_id', auth()->user()->id)
            ->where('ltd_id', $ltd)
            ->where('paid_type', 'DEBIT')
            ->where('currency_id', session('user.currency_id'))
            ->sum('paid_amount');

        $total = $totalPurchaseInvoices + $totalCredits;
        return [
            'total_paid' => $totalInvoicesPaids,
            'total_amount' => $totalPurchaseInvoices,
            'total' => $total - $totalInvoicesPaids,
        ];
    }

    public function sale_invoice_grand_total($sale_invoice)
    {
        return Sale_product::where('invoice_id', $sale_invoice)
            ->where('sale_products.currency_id', session('user.currency_id'))
            ->join('currency_attends', 'sale_products.currency_id', '=', 'currency_attends.id')
            ->join('currencies', 'currency_attends.currency_id', '=', 'currencies.id')
            ->selectRaw('currencies.symbol, currencies.code ,SUM(sale_products.grand_total) as grand_total')
            ->groupBy('currencies.symbol', 'currencies.code')->first();
    }

    public function createPaymentDetails($request, $money_resource, $type, $paymentType)
    {
        return PaymentDetails::create([
                'money_resources_id' => $money_resource, 
                'currency_id' => session('user.currency_id'), 
                'empolyee_id' => 1,
                'amount' => $request->paid_amount,
                'type' => $type, 
                'payment_type' => $paymentType, 
                'paid_description' => $request->paid_description, 
                'user_id' => session('user.id'), 
                'admin_id' => session('user.admin_id')
            ]);
    }

    public function productExpanseTypesForDropdown()
    {
        return Product_expenses_type::where('user_id', auth()->user()->id)->select(['expenses_type', 'id']);
    }
}
