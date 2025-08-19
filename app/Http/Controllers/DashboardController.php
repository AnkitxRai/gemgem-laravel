<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('/dashboard');
        // return redirect()->route('dash');
    }

    public function user($id) {
        dd($id);
    }

    public function routemodeluser(User $user) {
        dd($user);
    }
}
