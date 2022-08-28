<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PaymentLog;
use Carbon\Carbon;

class Activations
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
        //activation profile
        if(!empty(Auth()->user())){
            if(Auth()->user()->user_id_status == 0){
                return redirect()->route('subscriprion.index');
            }
        }
        return $next($request);
    }
}
