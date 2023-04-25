<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Models\Admin;
use Carbon\Carbon;
use App\Mail\AdminRestPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Admincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// login
    public function login()
    {
        return view('admin.login.login');
    }
//    end of login
    public function DashBord()
    {
        return view('admin.layouts.index');
    }

//logout
    public function logout()
    {
        admin()->logout();
        return view('admin.login.login');
    }
//    end of logout
    public function GoRestPassword()
    {

        return view('admin.login.RestAdminPassword');
    }
            //RestPassword
    public function RestPassword()
    {

      $admin=Admin::where('email',request('email'))->first();
//      dd($admin);
      if(!empty($admin)){

          $token=app('auth.password.broker')->createToken($admin);
//          dd($token);
          $data=DB::table('password_resets')->insert([
              'email'=>request('email') ,
             'token'=> $token,
              'created_at'=>Carbon::now()

          ]);
          return new AdminRestPassword([
              'data'=>$admin,
            'token'=>$token
          ]);
      }
      return redirect()->route('dash.login');
    }
//    end of RestPassword

//Login page
    public function dologin()
    {

       // $remember_me =request('remember_me')==1?true:false;
//       dd($remember_me);
        if (admin()->attempt
        ([
            'email'=>request('email') ,
            'password'=>request('password'),
         //   $remember_me
        ]))
        {
           return view('admin.index');
        }else
        {

            return view('admin.login.login');

        }
//        end of login page
    }



}
