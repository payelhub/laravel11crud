<?php

namespace App\Http\Controllers;

use App\Models\user_show_;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index() {
        $users = user_show_::orderBy('id', 'ASC')->get();
        return view('users.list', [
            'users' => $users
        ]);
    }
    public function create() {
        return view('users.create');
    }
    public function store(Request $request) {
        $rules=[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8|max:12'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('users.create')->withInput()->withErrors($validator);
        }
        $user=new user_show_();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();
        return redirect()->route('users.index')->with('success','user added successfully');
    }
    public function edit($id) {
        $users=user_show_::findOrFail($id);
        return view('users.edit',[
            'users'=>$users
        ]);
    }
    public function update(Request $request,$id) {
        $users=user_show_::findOrFail($id);
        $rules=[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8|max:12'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('users.edit')->withInput()->withErrors($validator);
        }
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=$request->password;
        $users->save();
        return redirect()->route('users.index')->with('success','user updated successfully');
    }
    public function destroy($id) {
        $users=user_show_::findOrFail($id);
        $users->delete();
        return redirect()->route('users.index')->with('success','user deleted successfully');
    }
}
