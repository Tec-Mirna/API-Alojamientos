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
        
        
       
       
}
