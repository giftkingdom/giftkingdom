<?php

namespace App\Http\Middleware\web_setting;

use Closure;
use Auth;
use DB;
use App\Models\Web\Usermeta;

class CheckIfAllowedVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next){

        $check =  DB::table('users')->where('id',Auth()->user()->id)->whereIn('role_id',[1,2,4])->first();

        if($check == null) :

            return  redirect('/');

        else :

            if( $check->role_id == 4 ) :

                $aprroved =  Usermeta::where([['user_id', $check->id],['meta_key','approved']])->first();


                if( $aprroved ) :

                    return $next($request);

                else :

                    return redirect('/dashboard/'.$check->user_name);

                endif;

            else :

                return $next($request);
                
            endif;

        endif;
    }
}
