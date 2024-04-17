<?php

namespace App\Http\Controllers;

use App\models\Communities;
use Illuminate\Http\Request;

class CommunitiesController extends Controller
{
    public function createCommunity(Request $request){
        $request->validate([
            "community_name" => "required",
            "description" => "required",
            "profile_id" => "required",
        ]);

        $community = Communities::create([
            'community_name' => $request->community_name,
            'description' => $request->description,
            'profile_id'=> $request->profile_id,
        ]);

        return response()->json($community);
    }
     public function readAllCommunities(){
        $communities = Communities::all();
        if(!$communities){
            return response()->json("No Community Was found");
        }
        else {
            return response()->json($communities);
        }
     }

     public function readCommunity($id){
        try{
            $community = Communities::findOrFail($id);
            if ($community){
                return response ()->json($community);
            }
            else{
                 return response()->json("No Community was found with community ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Community Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateCommunity ($id, Request $request){
        try{
            $request ->validate([
                "community_name" =>"required",
                "description" => "required",
                "profile_id" => "required"

            ]);
            $community = Communities::findOrFail($id);
            if ($community){
                $community -> community_name = $request->community_name;
                $community -> description = $request->description;
                $community -> profile_id = $request->profile_id;
                $community->save();
                return response ()->json($community);
            }
            else{
                 return response()->json("No Community was found with community ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteCommunity ($id){
        try{
            $community = Communities::findOrFail($id);
            if ($community){
                Communities::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Community was found with community ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
