<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function createPost(Request $request){
        $request->validate([
            "user" => "required",
            "content" => "required",
            "image" => "image|mimes:jpeg,png,jpg|2048",
            "likes" => "required",
            "comments" => "required",
        ]);
        if($request->hasFile('image')){
            $filename=$request->file('image')->store('post','public');
        }else{
            $filename = null;
        }

        $post = Posts::create([
            'user' => $request->user_name,
            'content' => $request->email,
            'image' => $filename,
            'likes' => $request->communities,
            'comments' => $request->full_name,
        ]);
        

        return response()->json($post);
    }
     public function readAllPosts(){
        $posts = Posts::all();
        if(!$posts){
            return response()->json("No Post Was found");
        }
        else {
            return response()->json($posts);
        }
     }

     public function readPost($id){
        try{
            $post = Posts::findOrFail($id);
            if ($post){
                return response ()->json($post);
            }
            else{
                 return response()->json("No Post was found with post ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Post Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updatePost ($id, Request $request){
        try{
            $request ->validate([
                "user" => "required",
                "content" => "required",
                "image" => "image|mimes:jpeg,png,jpg|2048",
                "likes" => "required",
                "comments" => "required",
            ]);
            if($request->hasFile('post_pic')){
                $filename=$request->file('post_pic')->store('post','public');
            }else{
                $filename = null;
            }
            $post = Posts::findOrFail($id);
            if ($post){
                $post -> user = $request->user;
                $post -> content = $request->content;
                $post -> image = $filename;
                $post -> likes = $request->communities;
                $post -> comments = $request->full_name;
                return response ()->json($post);
            }
            else{
                 return response()->json("No Post was found with post ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deletePost ($id){
        try{
            $post = Posts::findOrFail($id);
            if ($post){
                Posts::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Post was found with post ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
