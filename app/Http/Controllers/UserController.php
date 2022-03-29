<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService) {
            $this->userService = $userService;
    }


    public function index() {
        if (Auth::user()->role_id == 1) {
            return view('admin.profile', ['data' => Auth::user()]);
        }
    }
}
