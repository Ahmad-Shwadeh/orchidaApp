<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionTimeoutMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('remember_me')) {
            $lastActivity = Session::get('last_activity');

            if ($lastActivity && now()->diffInMinutes($lastActivity) > 30) {
                Session::flush();
                return redirect('/login')->with('error', '⏰ انتهت الجلسة تلقائيًا بعد 30 دقيقة من عدم النشاط');
            }

            Session::put('last_activity', now());
        }

        return $next($request);
    }
}
