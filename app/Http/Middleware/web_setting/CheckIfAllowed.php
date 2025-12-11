<?php

namespace App\Http\Middleware\web_setting;

use Closure;
use Auth;
use DB;

class CheckIfAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

      $check =  DB::table('users')->where('id',Auth()->user()->id)->whereIn('role_id',[1,2])->first();

      if($check == null) :

        return  redirect('/');

      else :
        return $next($request);
        
      endif;
    }
  }
