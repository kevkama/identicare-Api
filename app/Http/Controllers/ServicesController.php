<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function createService(Request $request){
        $request->validate([
            "field_name" => "required",
        ]);
       

        $service = Services::create([
            'field_name' => $request->field_name,
        ]);
        

        return response()->json($service);
    }
     public function readAllServices(){
        $services = Services::all();
        if(!$services){
            return response()->json("No Service Was found");
        }
        else {
            return response()->json($services);
        }
     }

     public function readService($id){
        try{
            $service = Services::findOrFail($id);
            if ($service){
                return response ()->json($service);
            }
            else{
                 return response()->json("No Service was found with service ID:",$id);
            }
                
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Service Does not exist with such an ID'
            ],400);
        }
            
    }

    public function updateService ($id, Request $request){
        try{
            $request ->validate([
                "field_name" => "required",
            ]);
            
            $service = Services::findOrFail($id);
            if ($service){
                $service -> field_name = $request->field_name;
                return response ()->json($service);
            }
            else{
                 return response()->json("No Service was found with service ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to update record'
            ],400);
        }
    }

    public function deleteService ($id){
        try{
            $service = Services::findOrFail($id);
            if ($service){
                Services::destroy($id);
                return response()->json('Reccord has been successfully deleted');
            }
            else{
                return response()->json("No Service was found with service ID:",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Unable to delete record'
            ],400);
        }
        
    }
}
