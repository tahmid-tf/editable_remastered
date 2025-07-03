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
            return redirect()->route('editors');
        }

        if (auth()->user()->hasRole('user')) {
            return redirect()->route('user.settings');
        }

        abort(403);
    }


}
