<?php

namespace App\Http\Controllers;

use App\Models\Chats;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function createChat(Request $request){
        $request->validate([
            "sender" => "required",
            "reciever" => "required"
        ]);

        $chat = Chats::create([
            'sender' => $request->sender,
            'reciever' => $request->reciver,
        ]);

        return response()->json($chat);
    }
     public function readAllChats(){
        $chats = Chats::all();
        if(!$chats){
            return response()->json("No Chat Was found");
        }
        else {
            return response()->json($chats);
        }
     }

     public function readChat($id){
        try{
            $chat = Chats::findOrFail($id);
            if ($chat){
                return response ()->json($chat);
            }
            else{
                 return response()->json("No Chat was found with chat ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Chat Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateChat ($id, Request $request){
        try{
            $request ->validate([
                "likes_counter" =>"required",
                "comment_counter" => "required"

            ]);
            $chat = Chats::findOrFail($id);
            if ($chat){
                $chat -> likes_counter = $request->likes_counter;
                $chat -> comment_counter = $request->comment_counter;
                $chat->save();
                return response ()->json($chat);
            }
            else{
                 return response()->json("No Chat was found with chat ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteChat ($id){
        try{
            $chat = Chats::findOrFail($id);
            if ($chat){
                Chats::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Chat was found with chat ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
