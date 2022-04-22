<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @param  string|null  ...$guards
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, ...$guards)
  {
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
      if (Auth::guard($guard)->check()) {
        // return redirect(RouteServiceProvider::HOME);
        if (auth()->user()->role_id == User::ROLE_ADMIN)
          return redirect()->route('admin.dashboard.index');

        if (auth()->user()->role_id == User::ROLE_PIC)
          return redirect()->route('pic.dashboard.index');

        if (auth()->user()->role_id == User::ROLE_USER)
          return redirect()->route('user.dashboard.index');
      }
    }

    return $next($request);
  }
}
