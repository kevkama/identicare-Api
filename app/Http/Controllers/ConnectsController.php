<?php

namespace App\Http\Controllers;

use App\Models\Connects;
use Illuminate\Http\Request;

class ConnectsController extends Controller
{
    public function createConnect(Request $request){
        $request->validate([
            "user" => "required",
        ]);

        $connect = Connects::create([
            'user' => $request->user,
        ]);

        return response()->json($connect);
    }
     public function readAllConnects(){
        $communities = Connects::all();
        if(!$communities){
            return response()->json("No Connect Was found");
        }
        else {
            return response()->json($communities);
        }
     }

     public function readConnect($id){
        try{
            $connect = Connects::findOrFail($id);
            if ($connect){
                return response ()->json($connect);
            }
            else{
                 return response()->json("No Connect was found with connect ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Connect Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateConnect ($id, Request $request){
        try{
            $request ->validate([
                "user" =>"required",
            ]);
            $connect = Connects::findOrFail($id);
            if ($connect){
                $connect -> user = $request->user;
                $connect->save();
                return response ()->json($connect);
            }
            else{
                 return response()->json("No Connect was found with connect ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteConnect ($id){
        try{
            $connect = Connects::findOrFail($id);
            if ($connect){
                Connects::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Connect was found with connect ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
