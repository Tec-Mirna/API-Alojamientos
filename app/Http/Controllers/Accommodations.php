<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accomodation;

class Accommodations extends Controller
{
    function test(){
        return response()->json([
        'status'=> true,
        'message' => 'api working fine'

        ]);
    }

    /* Obtner todos */
    public function accomodations(){

        $accomodations = Accommodation::all(); /* SELECT * FROM [nombre_tabla] */
        return response()->json([
            'status' => true,
            'message' => 'Get all accomodations successfully',
            'data' => $accomodations
        ]);
    }


    /* Traer por id */
    public function accomodation($id){

        $accomodation = Accomodation::find($id); /* Obtener 1 por id */

        /* Validaciones  vacía */
        if(!$accomodation){
            return response()->json([
                'status' => false,
                'message' => 'Accomodation with id ' . $id . 'Not found',
                'data' => $accomodation
            ], 404); /* Responde mal */
        }


        return response()->json([
            'status' => true,
            'message' => 'Get accomodation with id ' . $id,
            'data' => $accomodation
        ], 200); /* Responde bien */
    }

/* POST */
    public function createAccomodation(Request $request){ 
        /* Donde el nombre sea igual a request name */
        $accomodationDatabase = Accomodation::where('name', $request->name)->first();
       
        if($accomodationDatabase){
            return response()->json([
                'status' =>  false,
                'message' => 'Accomodation alredy exist',
                'data' => 'NOT data'
            ], 409); 
        }
      
        $accomodation = Accomodation::create($request->all()); /* INSERT INTO */
        return response()->json([
            'status' =>  true,
            'message' => 'New ccomodation created',
            'data' => $accomodation
        ], 201); 

    }

    /* PUT */
    public function updateAccomodation( Request $request, $id){

        $accomodation = Accomodation::update($request->all());

        return response()->json([
            'status' =>  true,
            'message' => 'Update accomodation with id',
            'data' => $accomodation
        ]);
    }

    /* DELETE */
    public function deleteAccomodation($id){

        $accomodation = Accomodation::delete($id);

        return response()->json([
            'message' => 'Delete accomodation with id' . $id . 'deleted.'
        ]);
    }    
       
}
