<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->paginate(20);
        
        return view('backend.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     =>'required|max:120',
            'email'    =>'required|email|unique:users',
            'password' =>'required|min:5|confirmed'
        ]);
        
        $user = User::create([
                                'name' => $request->name, 
                                'email' => $request->email, 
                                'password' => bcrypt($request->password)
                            ]); 

       

        // flash('User successfully added!')->success();
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
        $user = User::findOrFail($id); //Get user with specified id
        
        
        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //Validate name, email and password fields
         $this->validate($request, [
            'name'     =>'required',
            'email'    =>'required|email|unique:users,email,'.$id,
            'admin_password' =>'required'
        ]);

        //check admin password
        if ( ! \Hash::check($request->admin_password, Auth::user()->password)) {

            return redirect()->back()->with('error', 'Wrong admin password.');
        }

        $user = User::findOrFail($id); //Get role specified by id
        
        if ($request->password) {
            $user->email = $request->email; 
            $user->name = $request->name; 
            $user->password = bcrypt($request->password); 
        } else {
            $user->email = $request->email; 
            $user->name = $request->name; 
        }
        
        $user->save();
        
        

        return redirect()->route('user.index')->with('success', 'User successfully updated!');
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

        return redirect()->route('user.index')->with('success', 'User successfully deleted.');
    }
}
