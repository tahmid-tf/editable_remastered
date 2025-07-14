<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function dashboard()
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin-order-data');
        }

        if (auth()->user()->hasRole('user')) {
            return redirect()->route('users.orders.data');
        }

        abort(403);
    }


}
