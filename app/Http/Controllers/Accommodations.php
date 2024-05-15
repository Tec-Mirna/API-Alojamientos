<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return response()->json([
            'message' => 'Get all accomodations'
        ]);
    }


    /* Traer por id */
    public function accomodation($id){
        return response()->json([
            'message' => 'Get accomodation with id ' . $id
        ]);
    }

/* POST */
    public function createAccomodation(){
        return response()->json([
            'message' => 'New accomodation created'
        ]);
    }

    /* PUT */
    public function updateAccomodation($id){
        return response()->json([
            'message' => 'Update accomodation with id' . $id
        ]);
    }

    /* DELETE */
    public function deleteAccomodation($id){
        return response()->json([
            'message' => 'Delete accomodation with id' . $id
        ]);
    }
        
        
       
       
}
