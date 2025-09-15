<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $isAdmin = false;
    protected $user = null;

    public function __construct()
    {
        $this->middleware(['auth', function($request, $next) {
            $this->user = $this->user();
            $this->isAdmin = $this->isAdmin();
            session(['is_admin' => $this->isAdmin]);
            view()->share('is_admin', $this->isAdmin);
            view()->share('user', $this->user);
            return $next($request);
        }]);
    }
}
