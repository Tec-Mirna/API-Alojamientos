<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Validator;
use App\Models\Authentication;

class AuthenticationController extends Controller
{

   public function register(Request $request){
     $validator = Validator::make($request->all(), [
        'fullname' => 'required|string|max:100',
        'username' => 'required|string|max:30',
        'email' => 'required|email',
        'password' => 'required|string|min:8|max:24'
       
     ]);
     if($validator->fails()){
        return response()->json([
            'status' =>  false, 
            'message' => 'Validation error',
            'data' => $validator->errors()
        ], 409); // conflicto
     }

     $user = new Authentication();
     $user->fullname = $request->fullname;
     $user->username = strtolower($request->username); //strtolower todo minusculas ucwords mayúsculas
     $user->email = $request->email;
     $user->password = bcrypt ($request->password); // para encriptar (por defecto son 10 o 12 vueltas)
     $user->role = 'mortal';
     $user->save();

    return response()->json([
        'message' => 'Register working',
    ]);
   }

   public function login(Request $request){ 
    // Validar los datos recibidos en la solicitud
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:8|max:24'
    ]);

    // Si la validación falla, retornar un error
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'data' => $validator->errors()
        ], 409); // Conflicto
    }

    // Buscar el usuario por email
    $user = Authentication::where('email', $request->email)->first();

    // Si se encuentra el usuario, verificar la contraseña
    if ($user) {
        if (password_verify($request->password, $user->password)) { // Compara la contraseña encriptada con la contraseña en texto plano
            // Crear un token para el usuario
            $token = $user->createToken('auth-name')->plainTextToken;

            // Retornar una respuesta de éxito con el token
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'data' => $token
            ]);
        } else {
            // Contraseña inválida
            return response()->json([
                'status' => false,
                'message' => 'Invalid password',
                'data' => null
            ], 401); // No autorizado
        } 
    } else {
        // Usuario no encontrado
        return response()->json([
            'status' => false,
            'message' => 'User not found',
            'data' => null
        ], 404); // No encontrado
    }
}
   
   /* public function login(Request $request){
    return response()->json([
        'message' => 'Login working',
    ]);
   } */
}

