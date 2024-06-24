<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(){
        $blogs=Blog::OrderBy('created_at','ASC')->get();
        return view('blog.bloglist',[
            'blogs'=>$blogs
        ]);
    }
    public function show($id){
        $blogs=Blog::findOrFail($id);
        return view('blog.blogshow',[
            'blogs'=>$blogs
        ]);
    }
    
}
