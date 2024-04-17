<?php

namespace App\Http\Controllers;

use App\Models\Replys;
use Illuminate\Http\Request;

class ReplysController extends Controller
{
    public function createReply(Request $request){
        $request->validate([
            "content" => "required",
            "media" => "image|mimes:jpeg,png,jpg|2048",           
        ]);
        if($request->hasFile('media')){
            $filename=$request->file('media')->store('reply','public');
        }else{
            $filename = null;
        }

        $reply = Replys::create([
            'comment' => $request->user_name,
            'content' => $request->email,
            'media' => $filename,
            'like' => $request->communities,
        ]);
        

        return response()->json($reply);
    }
     public function readAllReplys(){
        $replys = Replys::all();
        if(!$replys){
            return response()->json("No Reply Was found");
        }
        else {
            return response()->json($replys);
        }
     }

     public function readReply($id){
        try{
            $reply = Replys::findOrFail($id);
            if ($reply){
                return response ()->json($reply);
            }
            else{
                 return response()->json("No Reply was found with reply ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Reply Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateReply ($id, Request $request){
        try{
            $request ->validate([
                "comment" => "required",
                "content" => "required",
                "media" => "image|mimes:jpeg,png,jpg|2048",
            ]);
            if($request->hasFile('media')){
                $filename=$request->file('media')->store('reply','public');
            }else{
                $filename = null;
            }
            $reply = Replys::findOrFail($id);
            if ($reply){
                $reply -> comment = $request->comment;
                $reply -> content = $request->content;
                $reply -> media = $filename;
                $reply -> like = $request->like;
                return response ()->json($reply);
            }
            else{
                 return response()->json("No Reply was found with reply ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteReply ($id){
        try{
            $reply = Replys::findOrFail($id);
            if ($reply){
                Replys::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Reply was found with reply ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
