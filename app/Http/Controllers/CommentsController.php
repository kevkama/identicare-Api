<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function createComment(Request $request){
        $request->validate([
            "user" => "required",
            "content" => "required",
            "media" => "image|mimes:gif|2048",
        ]);

        if($request->hasFile('media')){
            $filename=$request->file('media')->store('comment','public');
        }else{
            $filename = null;
        }

        $comment = Comments::create([
            'user' => $request->user,
            'content' => $request->content,
            'media'=> $filename,
            'like'=>$request->like,
            'reply'=> $request->reply,
        ]);

        return response()->json($comment);
    }
     public function readAllComments(){
        $communities = Comments::all();
        if(!$communities){
            return response()->json("No Comment Was found");
        }
        else {
            return response()->json($communities);
        }
     }

     public function readComment($id){
        try{
            $comment = Comments::findOrFail($id);
            if ($comment){
                return response ()->json($comment);
            }
            else{
                 return response()->json("No Comment was found with comment ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Comment Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateComment ($id, Request $request){
        try{
            $request ->validate([
                "user" =>"required",
                "content" => "required",
                "media" => "image|mimes:gif|2048"

            ]);

            if($request->hasFile('media')){
                $filename=$request->file('media')->store('comment','public');
            }else{
                $filename = null;
            }

            $comment = Comments::findOrFail($id);
            if ($comment){
                $comment -> user = $request->user;
                $comment -> content = $request->content;
                $comment -> media = $filename;
                $comment -> like = $request->like;
                $comment -> reply = $request->reply;
                $comment->save();
                return response ()->json($comment);
            }
            else{
                 return response()->json("No Comment was found with comment ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteComment ($id){
        try{
            $comment = Comments::findOrFail($id);
            if ($comment){
                Comments::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Comment was found with comment ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
