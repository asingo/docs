<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = [
            'title' => "Console"
        ];
        return view('home', $data);
    }
    public function listUser()
    {
        $user = User::all();

        $data = [
            'title' => 'List User',
            'data' => $user
        ];

        return view('user/list', $data);
    }
    public function addUser()
    {
        $data = [
            'title' => 'Add User',
        ];

        return view('user/add', $data);
    }
    public function delUser($id)
    {
        User::where('id', $id)->delete();
        Session::flash('message', 'User Deleted Successfully');
        return redirect('/home/user');
    }
    public function editUser(Request $request)
    {
        User::where('id', $request->id)->update([
            'password' => Hash::make($request->password)
        ]);
        Session::flash('message', 'Password Changed Successfully');
        return redirect('/home/user');
    }
    public function docsMan(Request $request)
    {
        $data = [
            'title' => 'Docs Manager',
        ];

        return view('docs/index', $data);
    }
}
