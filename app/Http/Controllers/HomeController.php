<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

use Illuminate\Support\Facades\Auth; 

class HomeController extends Controller
{
   public function index()
   {
      $data['categories'] = Category::all();
      return view("home.home", $data);
   }
   public function login(Request $req)
   {
      if ($req->isMethod("post")) {
         $data = $req->validate([
            "email" => "required",
            "password" => "required",
         ]);

         if (Auth::attempt($data)) {
            return redirect()->route("home.index")->with("success","login Successfully"); // Add the 'return' statement here
         } else {
            return redirect()->back()->with("error", "Email or password invalid");
         }
      }

      return view("home.login");
   }
   public function signup(Request $request)
   {
      if ($request->isMethod("post")) {
         $data = $request->validate([
            "email" => "required",
            "password" => "required",
            "name" => "required"
         ]);

         $data['password'] = bcrypt($data['password']);
         User::create($data);

         return redirect()->route('login')->with("success","SignUp successfully");
      }
      return view("home.signup"); 
   }

   public function logout(Request $req){
      Auth::logout();
      return redirect()->route("login")->with("error","Logout successfully");
   }
}
