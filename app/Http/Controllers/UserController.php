<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role != 'superadmin') {
            abort(403, 'Tidak Memiliki Akses!');
        }

        if ($request->has('search') && $request->search !== null) {
            $search = strtolower($request->search);
            $users = User::whereRaw('LOWER(name) LIKE ?', ['%'.$search.'%'])
                ->paginate(10)
                ->appends($request->only('search'));
        } else {
            $users = User::paginate(10);
        }

        return view('superadmin.user.index', compact('users'));
    }


}
