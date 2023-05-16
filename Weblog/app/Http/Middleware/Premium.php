<?php

namespace App\Http\Middleware;

use App\Models\Artical;
use Closure;
use Illuminate\Http\Request;

class Premium
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
        //get artical
        $artical = $request -> route("artical");

        //check if artical is premium
        if($artical -> isPremium)
        {
            //check if user is premium
            if(auth() -> user() == null || !auth() -> user() -> isPremium)
            {
                //return to index
                return redirect("/");
            }
        }

        return $next($request);
    }
}
