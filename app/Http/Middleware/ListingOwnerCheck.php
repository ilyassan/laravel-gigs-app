<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Listing;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListingOwnerCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $listing = Listing::find($request->route('listing'));

         if($listing && $listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $request->merge(['listing' => $listing]);

        return $next($request);
    }
}
