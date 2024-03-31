<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\forgotpassword;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login ()
    {
     // dd(Hash::make(12345678));
     if(!empty(Auth::check()))
     {
      if(Auth::user()->user_type ==1)
        {
          return redirect('admin/dashboard');
        }
        else if(Auth::user()->user_type ==2)
        {
          return redirect('teacher/dashboard');
        }
        else if(Auth::user()->user_type ==3)
        {
          return redirect('student/dashboard');
        }
        else if(Auth::user()->user_type ==4)
        {
          return redirect('parent/dashboard');
        }
     }
      return view('auth.login');
    }

    public function AuthLogin (Request $request)
    {
      $remember = !empty($request->remember) ? true : false ;
      
      if (Auth::attempt(['email' => $request ->email, 'password' =>  $request ->password], $remember))
      {

        if(Auth::user()->user_type ==1)
        {
          return redirect('admin/dashboard');
        }
        else if(Auth::user()->user_type ==2)
        {
          return redirect('teacher/dashboard');
        }
        else if(Auth::user()->user_type ==3)
        {
          return redirect('student/dashboard');
        }
        else if(Auth::user()->user_type ==4)
        {
          return redirect('parent/dashboard');
        }
       
      }
      else 
      {
        return redirect()->back()->with('error', 'please enter correct email and password');
      }
    }

    public function forgotpassword()
    {
      return view('auth.forgot');
    }

    public function reset($remember_token)
    {
      $user = User::getTokenSingle($remember_token);
      if(!empty($user))
      {
        $data['user'] = $user ; 
        return view('auth.reset');
      }
      else
      {
        abort(404); 
      }
    }


    public function PostforgotPassword(Request $request)
{
    $user = User::getEmailSingle($request->email);

    if (!empty($user)) {
        $user->remember_token = Str::random(30);
        $user->save();

        Mail::to($user->email)->send(new ForgotPasswordMail($user));

        return redirect()->back()->with('success', "Veuillez vérifier votre e-mail et réinitialiser votre mot de passe");
    } else {
        return redirect()->back()->with('error', "E-mail non trouvé dans le système");
    }
}


    public function PostReset($token, Request $request)
    {
      if($request->password == $request->cpassword)
      {
        $user = User::getTokenSingle($token);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(url(''))->with('success', "PASSWORD successfully reset");
      }
      else
       {
        return redirect()->back()->with('error', "Password and confirm password does not match");
      }
      
    }
    
    public function logout()
    {
      Auth::logout();
      return redirect(url(''));
    }
}
