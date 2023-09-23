<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;

class UserController extends Controller
{  
     /*
        * to display the user Dashboard
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function userDashboard(){
        return view('User.dashboard');
    }
    /*
        * to store the user post data into database
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function postStore(Request $request){
        $data = array(
            'title'=>$request->title,
            'user_id'=>Auth::user()->id,
            'description'=>$request->description
        );
        $post = Post::create($data);
        return redirect()->route('user.Dashboard')->with(['success'=>'Post Created Successfully']);
    }
    /*
        * To show only Logged-in user Post
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function viewPost(){
        $user = auth()->user();
        $posts = Post::where('user_id',$user->id)->get();
        return view('User.view',compact('posts'));
    }
    /*
        * To edit Post
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function editPost(Request $request){
        $id = $request->id;
        $post = Post::find($id);
        return view('User.edit',compact('post'));
    }
    /*
        * To update Post
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function updatePost(Request $request){
        $id = $request->id;
        $data = array(
            'title'=>$request->title,
            'description'=>$request->description
        );
        $post = Post::find($id);
        $post->update($data);
        return redirect()->route('view.post');
    }
    /*
        * To Delete Post
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function destroy(Request $request){
        $id = $request->id;
        $post = Post::find($id);
        $post->delete();
        return response()->json('success');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
