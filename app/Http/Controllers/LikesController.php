<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function createLike(Request $request){
        $request->validate([
            "user" => "required",
        ]);
        
        $like = Likes::create([
            'user' => $request->user,
        ]);
        

        return response()->json($like);
    }
     public function readAllLikes(){
        $likes = Likes::all();
        if(!$likes){
            return response()->json("No Like Was found");
        }
        else {
            return response()->json($likes);
        }
     }

     public function readLike($id){
        try{
            $like = Likes::findOrFail($id);
            if ($like){
                return response ()->json($like);
            }
            else{
                 return response()->json("No Like was found with like ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Like Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateLike ($id, Request $request){
        try{
            $request ->validate([
                "user" => "required",
            ]);
            
            $like = Likes::findOrFail($id);
            if ($like){
                $like -> user = $request->user;
                return response ()->json($like);
            }
            else{
                 return response()->json("No Like was found with like ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteLike ($id){
        try{
            $like = Likes::findOrFail($id);
            if ($like){
                Likes::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Like was found with like ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
