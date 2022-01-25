<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $searchKeyWord = "";

        return view($this->path_to_view . 'listUser', compact(['users', 'searchKeyWord']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path_to_view . 'addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        $password = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'password' => $password,
            'role_id' => $request->role_id,
        ]);
        
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view($this->path_to_view . 'editUser', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $password = Hash::make($request->password);
        User::where('id', $id)->update([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $password,
            'role_id' => $request->role_id,
        ]);
    
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }
    
    public function search(Request $request)
    {
        $searchKeyWord = $request->input('search');
        $users = User::where('name', 'LIKE', "%{$searchKeyWord}%")
            ->orWhere('email', 'LIKE', "%{$searchKeyWord}%")
            ->get();
            
        return view($this->path_to_view . 'listUser', compact('users', 'searchKeyWord'));
    }
}
