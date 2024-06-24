<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogCRUD extends Controller
{
    public function index(){
        $blogs=Blog::orderBy('created_at','ASC')->get();
        return view('blog.admin.blogtable',[
            'blogs'=>$blogs
        ]);
    }
    public function create(){
        return view('blog.admin.create');
    }
    public function store(Request $request){
        $rules=[
            'title'=>'required',
            'description'=>'required'
        ];
        if($request->image !=""){
            $rules['image']='image';
        }
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('blog.edit')->withInput()->withErrors($validator);
        }
        $blogs=new Blog();
        $blogs->title=$request->title;
        $blogs->description=$request->description;
        $blogs->save();
        if($request->image !=""){
            //here we will store image
       $image=$request->image;
       $ext=$image->getClientOriginalExtension();
       $imageName=time().'.'.$ext;
       //save image to product directory
       $image->move(public_path('uploads/blog'),$imageName);
       //save image in db
       $blogs->image=$imageName;
       $blogs->save();
        }
        
        return redirect()->route('blog.index')->with('success','blog added succesfully');
    }
    public function edit($id){
        $blogs=Blog::findOrFail($id);
        return view('blog.admin.blogedit',[
            'blogs'=>$blogs
        ]);
    }
    public function update(Request $request,$id){
        $blogs=Blog::findOrFail($id);
        $rules=[
            'title'=>'required',
            'description'=>'required'
        ];
        if($request->image !=""){
            $rules['image']='image';
        }
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->route('blog.create')->withInput()->withErrors($validator);
        }
        $blogs->title=$request->title;
        $blogs->description=$request->description;
        $blogs->save();
        if($request->image !=""){
            File::delete(public_path('uploads/blog/'.$blogs->image));
            //here we will store image
       $image=$request->image;
       $ext=$image->getClientOriginalExtension();
       $imageName=time().'.'.$ext;
       //save image to product directory
       $image->move(public_path('uploads/blog'),$imageName);
       //save image in db
       $blogs->image=$imageName;
       $blogs->save();
        }
        
        return redirect()->route('blog.index')->with('success','blog updated succesfully');
    }
    public function destroy($id){
        $blogs=Blog::findOrFail($id);
        File::delete(public_path('uploads/blog/'.$blogs->image));
        $blogs->delete();
        return redirect()->route('blog.index')->with('success','blog deleted succesfully');
    }
}
