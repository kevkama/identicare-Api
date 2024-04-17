<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function createAnalytic(Request $request){
        $request->validate([
            "likes_counter" => "required",
            "comment_counter" => "required"
        ]);

        $analytic = Analytics::create([
            'likes_counter' => $request->likes_counter,
            'comment_counter' => $request->comment_counter,
        ]);

        return response()->json($analytic);
    }
     public function readAllAnalytics(){
        $analytics = Analytics::all();
        if(!$analytics){
            return response()->json("No Analytic Was found");
        }
        else {
            return response()->json($analytics);
        }
     }

     public function readAnalytic($id){
        try{
            $analytic = Analytics::findOrFail($id);
            if ($analytic){
                return response ()->json($analytic);
            }
            else{
                 return response()->json("No Analytic was found with analytic ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Analytic Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateAnalytic ($id, Request $request){
        try{
            $request ->validate([
                "likes_counter" =>"required",
                "comment_counter" => "required"

            ]);
            $analytic = Analytics::findOrFail($id);
            if ($analytic){
                $analytic -> likes_counter = $request->likes_counter;
                $analytic -> comment_counter = $request->comment_counter;
                $analytic->save();
                return response ()->json($analytic);
            }
            else{
                 return response()->json("No Analytic was found with analytic ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteAnalytic ($id){
        try{
            $analytic = Analytics::findOrFail($id);
            if ($analytic){
                Analytics::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Analytic was found with analytic ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
