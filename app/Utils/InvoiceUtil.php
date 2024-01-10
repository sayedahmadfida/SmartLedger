<?php
namespace App\Utils;

use App\Models\Product_details;
use App\Models\Sale_product;
use App\Models\Transaction;


class InvoiceUtil {

  public static function invoiceInfo($id){
    
    $totalPaid = Transaction::where('model_id',  $id)
      ->where('model_type', 'PURCHASE-INVOICE')
      ->selectRaw('sum(credit_amount) as total_paid')
      ->groupBy('model_type', 'model_id')
      ->first();
    
    $returnTotalPaid = $totalPaid == null ? 0 : $totalPaid->total_paid;


    $invoiceTotal = Product_details::where('invoice_id', $id)
      ->where('deleted_at', null)
      ->selectRaw('SUM(grand_total) as invoice_total, SUM(discounted_amount) as discounted_amount')
      ->groupBy('invoice_id')
      ->first();
    $returnInvoiceTotal = $invoiceTotal == null ? ['invoice_total' => 0, 'discounted_amount' => 0 ] : $invoiceTotal;
    
    return [$returnTotalPaid, $returnInvoiceTotal];
  } 



  public static function SaleInvoiceInfo($id){
    
    $totalPaid = Transaction::where('model_id',  $id)
      ->where('model_type', 'SALE-INVOICE')
      ->selectRaw('sum(credit_amount) as total_paid')
      ->groupBy('model_type', 'model_id')
      ->first();
    
    $returnTotalPaid = $totalPaid == null ? 0 : $totalPaid->total_paid;


    $invoiceTotal = Sale_product::where('invoice_id', $id)
      ->where('deleted_at', null)
      ->where('admin_id', session('user.admin_id'))
      ->selectRaw('invoice_id, SUM(grand_total) as invoice_total, SUM(discounted_amount) as discounted_amount')
      ->groupBy('invoice_id')
      ->first();
    $returnInvoiceTotal = $invoiceTotal == null ? ['invoice_total' => 0, 'discounted_amount' => 0 ] : $invoiceTotal;
    
    return [$returnTotalPaid, $returnInvoiceTotal];
  } 


}




?>