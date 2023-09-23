<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use Auth;


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
    /*
        * to view Forget password page
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function forgetPassword(){
        return view('forget-password');
    }
    /*
        * to check the email and send mail to verified email address
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function forgetPasswordstore(Request $request){
        $request->validate([
            'email' => "required|email|exists:users",
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forget-password',['token' => $token], function($message) use ($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect()->to(route('forget.password'))->with("success","We have send an email to reset password");
    }
    /*
        * to show reset password page and send token
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function resetPassword($token){
        return view('new-password',compact('token'));
    }
    /*
        * to reset the password in database by adding password and password confirmation
        * @author: Harsh Singh
        * @email: harshsingh565650@gmail.com
        * created-date: 23/09/2023
    */
    public function resetPasswordstore(Request $request){
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required|string|min:6|confirmed",
            "password_confirmation" => "required"
        ]);
        $updatePassword = DB::table('password_resets')
        ->where([
            "email" =>$request->email,
            "token" =>$request->token
        ])->first();

        if(!$updatePassword){
            return redirect()->to(route('reset.password'))->with("error","invalid");
        }
        User::where("email",$request->email)->update(["password" => Hash::make($request->password)]);
        DB::table("password_resets")->where(["email" => $request->email])->delete();
        return redirect()->to(route('login'))->with("success","password reset Successfully");
    }
}
