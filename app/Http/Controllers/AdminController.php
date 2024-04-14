<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function list()
    {   
        $data['getRecord'] = User::getAdmin();
        return view('admin.admin.list', $data);  
    }

    public function add()
    {
        $data['getRecord'] = User::getAdmin();
        return view('admin.admin.add', $data);  
    }

    public function insert(Request $request)
    {
        request()->validate([
        'email'=> 'required|email|unique:users'
        ]);
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->name);
        $user->user_type = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfuly crated");
    }
   
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            return view('admin.admin.edit',$data);
        }
          
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email'=> 'required|email|unique:users,email,'.$id
            ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfuly update");
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfuly deleted");
    }
   
}
