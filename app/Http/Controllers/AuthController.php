<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
class AuthController extends Controller
{
    public function login(){
        return view('admin.pages.login');
    }
    public function register(){
        return view('admin.pages.register');
    }
    public function storeUser(Request $req){
        $name = $req->name;
        $email = $req->email;
        $password = $req->password;
        $confirm = $req->cnf_password;
        $role = $req->role;
        if($password==$confirm){
            $email_exists = User::where('email','=',$email)->first();
            if($email_exists){
                return redirect()->back()->with('email_exists','Email already exists.');
            }
            else{
                $user = new User();
                $user->name = $name;
                $user->email = $email;
                $user->password = md5($password);
                $user->role = $role;
                if($user->save()){
                    return redirect()->back()->with('success','Successfully Registered. Waiting for approval.');
                }
            }        
        }
        else{
            return redirect()->back()->with('fail_pass','Passowrd Mismatch');
        }
    }

    public function loginUser(Request $req){
        $email = $req->email;
        $password = $req->password; // 123456
        $user = User::where('email','=',$email)
                    ->where('password','=',md5($password))
                    ->first(); // SELECT * from users WHERE email='' and password = ''
        if($user){
            if($user->is_approved==1){
                Session::put('username', $user->name);
                Session::put('userrole', $user->role);
                return redirect('admin/dashboard');
            }
            else {
                return redirect()->back()->with('fail','Not Approved Yet');
            }
        }
        else{
            return redirect()->back()->with('fail','Invalid email or password');
        }
    }

    public function logout(Request $request){
        $request->session()->forget(['username', 'userrole']);
        return redirect('admin/login');
    }
}
