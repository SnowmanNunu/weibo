<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store','index']
        ]);

        $this->middleware('guest',[
          'only' => ['create']
        ]);
    }
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

    // public function destroy()
    // {
    //   Auth::logout();
    //   session()->flash('success','You have exited succefully!');
    //   return redirect('login');
    // }

    public function index()
    {
      $users = User::paginate(10);
      return view('users.index',compact('users'));
    }

    public function edit(User $user)
    {
      $this->authorize('update',$user);
      return view('users.edit',compact('user'));
    }

    public function update(User $user,Request $requset)
    {
      $this->validate($requset,[
        'name'=>'required|max:50',
        'password'=>'required|confirmed|min:6'
      ]);

      $this->authorize('update',$user);

      $data=[];
      $data['name'] = $requset->name;
      if ($requset->password) {
        $data['password'] = bcrypt($requset->password);
      }
      $user->update($data);
      session()->flash('success','Update succeeded!');
      return redirect()->route('users.show',$user->id);
    }

    public function destroy(User $user)
    {
      $this->authorize('destroy',$user);
      $user->delete();
      session()->flash('success','Delete successfully!');
      return back();
    }

}
