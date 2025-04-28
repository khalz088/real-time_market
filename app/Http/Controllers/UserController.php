<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       $users = User::paginate(9);


       return view('dashboard.users.user', ['users'=>$users]);
    }




    public function updateRole(Request $request, User $user)
    {
        $user->update([
            'role_id' => $request->has('role_id') ? 2 : 1
        ]);

        return back()->with('success', 'Role updated successfully');
    }


    public function updateStatus(Request $request, User $user)
    {
        $user->update([
            'active' => $request->has('active') ? 1 : 0
        ]);

        return back()->with('success', 'Status updated successfully');
    }
    public function destroy(User $user)
    {

        $user->delete();

        return back();
    }
}
