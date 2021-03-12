<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;



class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userlist()
    {

        $users = User::all();
        return view('userlist',["users" => $users]) ;
    }

    public function joblist(){
        return view('joblist');
}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usercreate()
    {
        return view('usercreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersave(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $image = $request->file('file');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($request->password);
        $user->profileimage = $imageName;
        $user->save();
        $user->attachRole($request->role_id);
        return redirect('/dashboard/userlist');

    }

        /*$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($request->hasFile('file')) {

            $request->validate([
                'profileimage' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
             $request->file->store('img', 'public');

             // Store the record, using the new file hashname which will be it's new filename identity.
             $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profileimage' => $request->file->hashName()
            ]);
        }
            $user->attachRole($request->role_id);


            return redirect('/dashboard/userlist');*/





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function usershow(request $request)
    {
        /*$user= User::where("$request()->show");

        return view('usershow')->with('user', $user);
        */
        $user= User::where( 'id', $request->user)->first();

        return view('usershow', ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function useredit(request $request)
    {
        $user= User::where( 'id', $request->user)->first();

        return view ('useredit', ["user" => $user ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userupdate(Request $request)
    {
        $name = $request->name;
        $email = $request->email;


        $user = User::find($request->id);
        $user->name =$request->name;
        $user->email = $request->email;


        foreach ($user->roles as $role){
            $user->detachRole($role);
        }

        if ($request->hasfile('file')){

            $destination = 'images/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = $request->file('file');
            $extension = $image->getClientOriginalExtension();
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);
            $user->profileimage = $imageName;

        }

            $user->attachRole($request->role_id);

            $user->update();
            return redirect('/dashboard/userlist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user){

            $user -> delete();
            return redirect('/dashboard/userlist');

    }
}
