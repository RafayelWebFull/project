<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\ErrorHandler\Error\UndefinedFunctionError;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    public function userRoleCheck() {
        $this->userService->checkUserRole();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        User::query()->insert([
           'name' => $data['name'],
           'email' => $data['email'],
           'role_id' => $data['roleId'],
           'password' => Hash::make($data['password']),
            'created_at' => Carbon::now()
        ]);
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::query()->where('id', '=', $id)->first();
        return view('user.edit', ['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::query()->where('id', '=', $id)->first();
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->role_id = $data['roleId'];
        if(isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->update();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
    }
    public function profileUpdate(Request $request) {
        $data = $request->all();
        User::query()->find(Auth::user()->id)->update([
            'email' => $data['email'],
            'name' => $data['name']
        ]);
        return redirect('/profile');
    }
    public function getUsers(Request $request) {
        $users = DB::table('users')->where(function($query) {
            $query->where('role_id', '=', 1);
            $query->orWhere('role_id', '=', 3);
        })->get();
        $usersName = User::query()
            ->where('role_id', '=', 1)
            ->orWhere('role_id', '=', 3)
            ->select('name')
            ->get();
        return view('user.index', ['data'=> $users, 'usersName' => $usersName]);
    }
    public function changePassword(Request $request) {
        $validated = $request->validate([
            'password' => 'required:min:6',
            'rePassword' => 'required_with:password|same:password|min:6',
        ]);
        $data = $request->all();
        User::where('id', '=', Auth::user()->id)->update([
           'password' => Hash::make($data['password'])
        ]);
        Auth::logout();
        return redirect('/');
    }
}
