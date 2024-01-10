<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Currency_attend;

class AuthInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        // if (auth()->user()) {
            // $currency = Currency_attend::where('user_id', auth()->user()->id)->get();
            // if($currency->isEmpty()){
            //     return redirect()->route('user.setInfo');
            // }else {
            //     return 'not Empty';
            // }
        // }
        return $next($request);
    }
}
