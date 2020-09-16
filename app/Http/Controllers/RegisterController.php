<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Store;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $accounts = User::where('id', "!=",  auth()->user()->id)
        //                 ->where('store_id', '=', auth()->user()->store_id)
        //                 ->get();

        $accounts = User::all();
        return view('Accounts.index',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::all();
        return view('Accounts.create',compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        User::create($this->validateRequest());

        // $user = new User;
        // $user->firstname = $request->firstname;
        // $user->lastname = $request->lastname;
        // $user->username = $request->username;
        // $user->password = $request->password;
        // $user->role = $request->role;
        // $user->store_id = $request->store_id;
        // $user->save();
        
        return redirect('/account')->with('message', 'Successfully Created a New Account');





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stores = Store::all();
        $account = User::findOrFail($id);
        return view('Accounts.show',compact('account','stores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $account)
    {
        $account->update(request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required', 
            'store_id' => 'required',
            'role' => 'required'
        ]));

        return redirect('/account')->with('message','Account Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/account')->with('delete','Account Succesfully Deleted!');
    }

    private function validateRequest(){
        return request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required', 
            'password' => 'required|confirmed',
            'store_id' => 'required',
            'role' => 'required'
        ]);
    }
}
