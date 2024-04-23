<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function createProfile(Request $request){
        $request->validate([
            "user_name" => "required",
            "email" => "required",
            "profile_pic" => "image|mimes:jpeg,png,jpg|max:2048",
            "full_name" => "required",
            "bio" => "required",
        ]);
        if($request->hasFile('profile_pic')){
            $filename=$request->file('profile_pic')->store('profile','public');
        }else{
            $filename = null;
        }

        $profile = Profiles::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'profile_pic' => $filename,
            'full_name' => $request->full_name,
            'bio' => $request->bio,
        ]);
        

        return response()->json($profile);
    }
     public function readAllProfiles(){
        // $profiles = Profiles::all();
        $profiles = Profiles::join('users', 'profiles.user_name', '=', 'users.id')
        ->select('profiles.*','users.name as name', 'users.email as email')->get();

        if(!$profiles){
            return response()->json("No Profile Was found");
        }
        else {
            return response()->json($profiles);
        }
     }

     public function readProfile($id){
        try{
            $profile = Profiles::findOrFail($id);
            if ($profile){
                return response ()->json($profile);
            }
            else{
                 return response()->json("No Profile was found with profile ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Profile Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateProfile ($id, Request $request){
        try{
            $request ->validate([
                "user_name" => "required",
                "email" => "required",
                "profile_pic" => "image|mimes:jpeg,png,jpg|max:2048",
                "full_name" => "required",
                "bio" => "required",
            ]);
            if($request->hasFile('profile_pic')){
                $filename=$request->file('profile_pic')->store('profile','public');
            }else{
                $filename = null;
            }
            $profile = Profiles::findOrFail($id);
            if ($profile){
                $profile -> user_name = $request->user_name;
                $profile -> email = $request->email;
                $profile -> profile_pic = $filename;
                $profile -> full_name = $request->full_name;
                $profile -> bio = $request->bio;                
                return response ()->json($profile);
            }
            else{
                 return response()->json("No Profile was found with profile ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteProfile ($id){
        try{
            $profile = Profiles::findOrFail($id);
            if ($profile){
                Profiles::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Profile was found with profile ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
