<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleOperator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedRoles = Role::where('role', '!=', 'WARGA')
            ->where('role', '!=', 'ADMIN')
            ->pluck('id');

            // print_r(Auth::user());
        // if (!Auth::user()->canView($request->route()->parameter('resource'))) {
        //     return redirect()->back()->with('error', 'You do not have permission to view this resource.');
        // }

        if (in_array(Auth::user()->role_id, $allowedRoles->toArray())) {
            return $next($request);
        }

        return redirect('/login');
    }
}
