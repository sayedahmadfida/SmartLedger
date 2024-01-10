<?php

namespace App\Http\Middleware;

use Closure;
use Socialite;
use Illuminate\Http\Request;
use App\Models\CurrencyAttend;
use App\Models\Currency_attend;
use Illuminate\Support\Facades\Auth;

class SetSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (!$request->session()->has('user')) {
            $user = Auth::user();
            
            $currency = CurrencyAttend::where('admin_id', $user->admin_id)
            ->join('currencies as c', 'c.id', '=', 'currency_attends.currency_id')
            ->select(['c.code', 'c.symbol', 'c.country', 'currency_attends.id'])
            ->first();
            $sessionData = [
              'id' => $user->id,
              'first_name' => $user->f_name,
              'last_name' => $user->l_name,
              'email' => $user->email,
              'username' => $user->username,
              'type' => $user->type,
              'category_id' => $user->category_id,
              'admin_id' => $user->admin_id,
              'currency_id' => $currency->id,
              'currency_code' => $currency->code,
              'currency_symbol' => $currency->symbol,
              'currency_country' => $currency->country
            ];

            $request->session()->put('user', $sessionData);
        }
        return $next($request);
    }
}
