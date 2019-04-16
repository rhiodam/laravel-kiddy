<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login dulu');
        } else {
            return view('account.home');
        }
    }

    public function login()
    {
        return view('account.index');
    }

    public function loginPost(Request $request)
    {

        $email = $request->email;
        $password = $request->password;

        $data = Account::where('email', $email)->first();
        if ($data) { //apakah email tersebut ada atau tidak
            if (Hash::check($password, $data->password)) {
                Session::put('name', $data->name);
                Session::put('email', $data->email);
                Session::put('login', TRUE);
                return redirect('home_user');
            } else {
                return redirect('login')->with('alert', 'Password atau Email, Salah !');
            }
        } else {
            return redirect('login')->with('alert', 'Password atau Email, Salah!');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login')->with('alert', 'Kamu sudah logout');
    }

    public function register(Request $request)
    {
        return view('account.create');
    }

    public function registerPost(Request $request)
    {
//        try {
//
//        }
//
//        catch ( Exception $e ){
//
//        }

        $this->validate($request, [
            'name' => 'required|min:4',
//            'email' => 'required|min:4|email|unique:users',
            'email' => 'required|min:4|email',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);

        $data = new Account();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->plainpassword = ($request->password);
        $data->save();
        return redirect('/account/login')->with('alert-success', 'Kamu berhasil Register');
    }
}
