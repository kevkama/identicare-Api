<?php

namespace App\Http\Controllers;

use App\Models\Professionals;
use Illuminate\Http\Request;

class ProfessionalsController extends Controller
{
    public function createProfessional(Request $request){
        $request->validate([
            "name" => "required",
            "services_id" => "required",
            "professional_pic" => "image|mimes:jpeg,png,jpg|2048",
            "description" => "required",
        ]);
        if($request->hasFile('professional_pic')){
            $filename=$request->file('professional_pic')->store('professional','public');
        }else{
            $filename = null;
        }

        $professional = Professionals::create([
            'name' => $request->user_name,
            'services_id' => $request->services_id,
            'professional_pic' => $filename,
            'description' => $request->description,
        ]);
        

        return response()->json($professional);
    }
     public function readAllProfessionals(){
        $professionals = Professionals::all();
        if(!$professionals){
            return response()->json("No Professional Was found");
        }
        else {
            return response()->json($professionals);
        }
     }

     public function readProfessional($id){
        try{
            $professional = Professionals::findOrFail($id);
            if ($professional){
                return response ()->json($professional);
            }
            else{
                 return response()->json("No Professional was found with professional ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Professional Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateProfessional ($id, Request $request){
        try{
            $request ->validate([
                "name" => "required",
                "service_id" => "required",
                "profile_pic" => "image|mimes:jpeg,png,jpg|2048",
                "description" => "required",
            ]);
            if($request->hasFile('professional_pic')){
                $filename=$request->file('professional_pic')->store('professional','public');
            }else{
                $filename = null;
            }
            $professional = Professionals::findOrFail($id);
            if ($professional){
                $professional -> name = $request->name;
                $professional -> service_id = $request->service_id;
                $professional -> profile_pic = $filename;
                $professional -> description = $request->description;         
                return response ()->json($professional);
            }
            else{
                 return response()->json("No Professional was found with professional ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteProfessional ($id){
        try{
            $professional = Professionals::findOrFail($id);
            if ($professional){
                Professionals::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Professional was found with professional ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
