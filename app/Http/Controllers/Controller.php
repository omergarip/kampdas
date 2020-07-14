<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $notifications;
    protected $numOfNotifications;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(\auth()) {
            $this->middleware(function ($request, $next) {
                $this->notifications = Auth::user()->notifications ?? '';
                $this->numOfNotifications = Auth::user()->unreadNotifications->count() ?? '0';
                View::share('notifications', $this->notifications ?? '');
                View::share('numOfNotifications', $this->numOfNotifications ?? '');
                return $next($request);
            });
        }
    }
}
