<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Product;
use session;
use session_destroy;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        //dd($request->all());
        // return view('register.adduser');
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|max:12',
            'confirmpassword' => 'required|same:password',
            'status' => 'required',
        ]);
        // dd($request->all());

        $user = new Admin();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $res = $user->save();

        if (!empty($res))
            return json_encode(array('message' => 'User Added successfully', 'status' => 200));

        else
            return json_encode(array('message' => 'Student Record Added Not Inserted', 'status' => 500));
    }
    public function signin()
    {
        if (session()->has('username')) {
            return redirect('/dashboard');
        }
        return view('signin.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:12',

        ]);

        $admin = Admin::Where("email", "=", $request->email)->first();
        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $request->session()->put('username', $admin['username']);
                $request->session()->put('admin_id', $admin['admin_id']);
                return json_encode(array('message' => 'Succsessfuly', 'status' => 200, 'username', 'admin_id'));
            } else {
                return json_encode(array('message' => 'Password Not Match', 'status' => 500));
            }
        } else {

            return json_encode(array('message' => 'Wrong Email Or Password', 'status' => 500));
        }
    }
    public function dashboard()
    {
        
        $admin = Admin::select('admin_id', 'username', 'email', 'password')->where('admin_id', '=', Session()->get('admin_id'))->get();
        $data = array();

        if (Session()->has('username') && Session()->has('admin_id')) {

            $data3 = Admin::where('admin_id', '=', Session()->get('username'))->first();
            $data4 = Admin::where('admin_id', '=', Session()->get('admin_id'))->first();
            $data = $data3 . $data4;
        }
        return view('dashboard', compact('data', 'admin'));
    }
    public function logout(Request $request)
    {
        if (session()->has('username')) {
            session()->pull('username');
        }
        $request->session()->forget('username');

        return redirect('/signin');
    }
    public function updateuser($id, Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',

        ]);
        if (!empty($id)) {

            $is_update = Admin::where('admin_id', $id)->update([
                'username' => $request->username,
                'email' => $request->email,

            ]);
        }
        if (!empty($is_update))
            return json_encode(array('message' => 'User Update successfully', 'status' => 200));
        else
            return json_encode(array('message' => 'User  Not Update', 'status' => 500));
    }
    public function changepassword($id, Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'confirmnew' => 'required|same:newpassword',
        ]);
        // dd($request->all());
        if (!empty($id)) {
            $user = Session()->get('username');
            // $ss = Hash::make($request->oldpassword);
            // dd($ss);


            // $tpps = Hash::check($user->password, $request->oldpassword);
            // dd($tpps);
            if ($user) {
                $is_change = Admin::where([
                    ['admin_id', '=', $id],
                    ['username', '=', $user],
                    // ['password', '=', $request->oldpassword],
                ])->update([
                    'password' => Hash::make($request->newpassword),
                ]);
            } else {
                return json_encode(array('message' => 'User Old Password Not Match', 'status' => 500));
            }
        }
        if (!empty($is_change))
            return json_encode(array('message' => 'User Password successfully', 'status' => 200));
        else
            return json_encode(array('message' => 'User Password Not Change', 'status' => 500));
    }
}
