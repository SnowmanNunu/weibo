<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Status;
use Auth;

class StatusesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function store(Request $requset)
    {
      $this->validate($requset,[
        'content'=>'required|max:140'
      ]);

      Auth::user()->statuses()->create([
        'content' =>$requset->content
      ]);
      return redirect()->back();
    }

    public function destroy(Status $status)
    {
      $this->authorize('destroy',$status);
      $status->delete();
      session()->flash('success','You delete succesfully!');
      return redirect()->back();
    }
}
