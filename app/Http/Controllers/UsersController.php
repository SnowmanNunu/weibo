<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $requset)
    {
      $this->validate($requset,[
        'name'=>'required|max:50',
        'email'=>'required|email|unique:users|max:255',
        'password'=>'required|confirmed|min:6'
      ]);

      $user=User::create([
        'name'=>$requset->name,
        'email'=>$requset->email,
        'password'=>bcrypt($requset->password),
      ]);

      Auth::login($user);
      session()->flash('success','Welcome to weibo!');
      return redirect()->route('users.show',[$user]);
    }

    public function destroy()
    {
      Auth::logout();
      session()->flash('success','You have exited succefully!');
      return redirect('login');
    }

}
