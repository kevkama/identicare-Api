<?php

namespace App\Http\Controllers;

use App\Models\Costs;
use Illuminate\Http\Request;

class CostsController extends Controller
{
    public function createCost(Request $request){
        $request->validate([
            "institution_name" => "required",
            "services" => "required",
            "prices" => "required",
        ]);
        
        $cost = Costs::create([
            'institution_name' => $request->institution_name,
            'services' => $request->services,
            'prices' => $request->prices,
        ]);
        

        return response()->json($cost);
    }
     public function readAllCosts(){
        $costs = Costs::all();
        if(!$costs){
            return response()->json("No Cost Was found");
        }
        else {
            return response()->json($costs);
        }
     }

     public function readCost($id){
        try{
            $cost = Costs::findOrFail($id);
            if ($cost){
                return response ()->json($cost);
            }
            else{
                 return response()->json("No Cost was found with cost ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Cost Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateCost ($id, Request $request){
        try{
            $request ->validate([
                "institution_name" => "required",
                "services" => "required",
                "prices" => "required",
            ]);
            
            $cost = Costs::findOrFail($id);
            if ($cost){
                $cost -> institution_name = $request->institution_name;
                $cost -> services = $request->services;
                $cost -> prices = $request->prices;
                return response ()->json($cost);
            }
            else{
                 return response()->json("No Cost was found with cost ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteCost ($id){
        try{
            $cost = Costs::findOrFail($id);
            if ($cost){
                Costs::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Cost was found with cost ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
