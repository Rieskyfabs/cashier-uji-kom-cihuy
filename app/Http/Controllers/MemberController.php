<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && $request->search !== null) {
            $search = strtolower($request->search);
            $members = Member::whereRaw('LOWER(name) LIKE ?', ['%'.$search.'%'])
                ->orderByRaw('LOWER(name) ASC')
                ->paginate(10)
                ->appends($request->only('search'));
        }
        $members = Member::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    
}
