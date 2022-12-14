<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response;

class Company {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::User()->user_type != 'company') {
            if (!$request->ajax()) {
                return back()->with('error', _lang('Permission denied !'));
            } else {
                return new Response('<h5 class="text-center red">' . _lang('Permission denied !') . '</h5>');
            }
        }

        // if (get_option('mobile_verification') == 'enabled' && Auth::User()->sms_verified_at == null) {
        //     return redirect()->route('profile.mobile_verification');
        // }

        // if (get_option('enable_kyc') == 'yes' && Auth::User()->document_verified_at == null) {
        //     return redirect()->route('profile.document_verification');
        // }

        return $next($request);
    }
}
