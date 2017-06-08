<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        $this->authorize('view', new Video());

        $users = User::with('role')->paginate(15);

        return view('users.index', ['users' => $users]);
    }
}