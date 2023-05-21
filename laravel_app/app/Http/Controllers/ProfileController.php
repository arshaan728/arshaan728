<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function adduser() {
        return view('add-user');
    }

    public function saveuser(Request $request) {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'contact'=>['required'],
        //     'address'=>['required']
        // ]);
        
        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;
        $address = $request->address;
        $password = Hash::make($request->password);
        

        $user = new User();
        $user->name = $name;
        $user->email= $email;
        $user->password = $password;
        $user->contact = $contact;
        $user->address = $address;
        $user->save();
       

        return redirect()->back()->with('sucess','added success');


    }

    public function editstudent($id) {
        $data = User::where('id','=',$id)->first();
        return view('edit-student',compact('data'));
    }

    public function updateuser(Request $request) {
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;
        $address = $request->address;
        $password = $request->password;

        User::where('id','=',$id)->update([
            'name'=>$name,
            'email'=>$email,
            'contact'=>$contact,
            'address'=>$address,
            'password'=>$password,
        ]);
        return redirect()->back()->with('sucess','student updated');
    }

    public function destroyrecord($id){
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status'=>200,
            'message'=>'student deleted sucessfully',
        ]);
    }

    public function searchemail(){
        $search_text = $_GET['query'];
        $user= User::where('email','LIKE','%'.$search_text. '%')->get();

        return view('search',compact('user'));
    }
}
