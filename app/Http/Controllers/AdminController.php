<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;

class AdminController extends Controller
{
     /*
        * to display admin dashboard to create new post
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function adminDashboard(){
        return view('Admin.dashboard');
    }
     /*
        * to store the admin post data into database
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function adminPostStore(Request $request){
        $data = array(
            'title'=>$request->title,
            'user_id'=>Auth::user()->id,
            'description'=>$request->description
        );
        $post = Post::create($data);
        return redirect()->route('admin.Dashboard')->with(['success'=>'Post Created Successfully']);
    }
     /*
        * to display every post on admin log-in
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function viewAll(){
        $posts = Post::get();
        return view('admin.viewAll',compact('posts'));
    }
    /*
        * To edit Post
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function editAll(Request $request){
        $id = $request->id;
        $post = Post::find($id);
        return view('Admin.editAll',compact('post'));
    }
    /*
        * To update Post
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function updateAll(Request $request){
        $id = $request->id;
        $data = array(
            'title'=>$request->title,
            'description'=>$request->description
        );
        $post = Post::find($id);
        $post->update($data);
        return redirect()->route('admin.viewAll');
    }
}
