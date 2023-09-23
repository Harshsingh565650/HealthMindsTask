<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;
use Hash;

class BaseController extends Controller
{
    /*
        * to display every post on the home page
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 22/09/2023
    */
    public function home(){
        $post = Post::orderBy('id','desc')->get();
        return view('home',compact('post'));
    }
    /*
        * to display login page
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 22/09/2023
    */
    public function login(){
        // echo Hash::make('admin@123');
        return view('login');
    }
    /*
        * to check whether the user is authenticated or not ,if credential match with database
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 22/09/2023
    */
    public function loginCheck(Request $request){
        $data = array(
            'email' => $request->email,
            'password' => $request->password,
        );
    
        if(Auth::attempt($data)){
            // Check the user's role after successful login
            $user = Auth::user();
    
            if ($user->role === 'admin') {
                return redirect()->route('admin.Dashboard'); // Redirect to admin dashboard
            } else {
                return redirect()->route('user.Dashboard'); // Redirect to user dashboard
            }
        } else {
            return back()->withErrors(['message' => 'Invalid email or password']);
        }
    }
    
     /*
        * to display register page
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 22/09/2023
    */
    public function register(){
        return view('register');
    }
     /*
        * to store the register form data in database
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 22/09/2023
    */
    public function registerStore(Request $request){
        $data = array(
            'name'=>$request->first_name.' '.$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=> 'user'

        );
        $user = User::create($data);
        return redirect()->route('login');
    }
}
