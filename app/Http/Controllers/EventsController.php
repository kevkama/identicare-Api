<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function createEvent(Request $request){
        $request->validate([
            "name" => "required",
            "description" => "required",
            "profile_id" => "required",
        ]);
        
        $event = Events::create([
            'name' => $request->name,
            'description' => $request->description,
            'profile_id' => $request->profile_id,
        ]);
        

        return response()->json($event);
    }
     public function readAllEvents(){
        $events = Events::all();
        if(!$events){
            return response()->json("No Event Was found");
        }
        else {
            return response()->json($events);
        }
     }

     public function readEvent($id){
        try{
            $event = Events::findOrFail($id);
            if ($event){
                return response ()->json($event);
            }
            else{
                 return response()->json("No Event was found with event ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Event Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateEvent ($id, Request $request){
        try{
            $request ->validate([
                "name" => "required",
                "description" => "required",
                "profile_id" => "required",
            ]);
            
            $event = Events::findOrFail($id);
            if ($event){
                $event -> name = $request->name;
                $event -> description = $request->description;
                $event -> profile_id = $request->profile_id;
                return response ()->json($event);
            }
            else{
                 return response()->json("No Event was found with event ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteEvent ($id){
        try{
            $event = Events::findOrFail($id);
            if ($event){
                Events::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Event was found with event ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
