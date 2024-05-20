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
    // http://localhost:8000/api/v1/accomodation/all
    public function accomodations(){

        $accomodation = Accomodation::all(); /* SELECT * FROM [nombre_tabla] */
        return response()->json([
            'status' => true,
            'message' => 'Get all accomodations successfully',
            'data' => $accomodation
        ]);
    }


    /* Traer por id */
    // http://localhost:8000/api/v1/accomodation/id
    public function accomodation($id){

        $accomodation = Accomodation::find($id); /* Obtener 1 por id */

        /* Validaciones   */
        // Si el id no existe 
       if(!$accomodation){
            return response()->json([
                'status' => false,
                'message' => 'Accomodation with id ' . $id . ' Not found',
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
     // http://localhost:8000/api/v1/accomodation/
     // { "name": "The Grand Hotel", "address": "123 Main Street, City, Country", "capacity": 100, "rooms": 50, "image_url": "http://example.com/image.jpg", "price": 100.00, "description": "A luxurious hotel in the heart of the city." 

    public function createAccomodation(Request $request){ 
        /* Donde el nombre sea igual a request name */
       $accomodationDatabase = Accomodation::where('name', $request->name)->first(); // Si esta consulta encuentra un registro con el mismo nombre, error
       
        if($accomodationDatabase){
            return response()->json([
                'status' =>  false, 
                'message' => 'Accomodation already exists',
                'data' => 'Not data'
            ], 409); // conflicto
        } 
                                   // Con request all guradamos todo(atributos)
        $accomodation = Accomodation::create($request->all()); /* INSERT INTO */
        return response()->json([
            'status' =>  true,
            'message' => 'New ccomodation created',
            'data' => $accomodation
        ], 201); // creado

    }

    /* PUT */
    public function updateAccomodation( Request $request, $id){

       /*  $accomodation = Accomodation::update($request->all()); */

       // Busca por id  y comparo 
       $accomodation = Accomodation::find($id);
       if(!$accomodation){
         return response()->json([
            'status' =>  false,
            'message' => ' accomodation not found',
            'data' => 'Not data'
         ], 404);
       }
  // comparo
       $accomodation->update($request->all()); //Todo lo que mando mete en request

        return response()->json([
            'status' =>  true,
            'message' => 'Update accomodation with id',
            'data' => $accomodation
        ]);
    }

    /* DELETE */
    public function deleteAccomodation($id){

        $accomodation = Accomodation::find($id);
        if(!$accomodation){
          return response()->json([
             'status' =>  false,
             'message' => ' accomodation not found',
             'data' => 'Not data'
          ], 404);
        }

       $accomodation->delete();

        return response()->json([
            'status' =>  true,
            'message' => 'Accomodation with id' . $id . 'deleted.',
            'data' => $accomodation
        ]);
    }    
       
}
