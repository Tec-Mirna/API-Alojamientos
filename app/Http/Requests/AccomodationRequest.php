<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; // Valida datos de un formulario (default)
use Illuminate\Contracts\Validation\Validator;
/* use Illuminate\Support\Facades\Validator;  */// Valida datos de la api(trabajando en el mismo archivo)

class AccomodationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // si está en false, no me autoriza hacer solicitudes
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string',
            'capacity' => 'required|numeric',
            'rooms' => 'required|numeric',
            'image_url' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ];
    }
 /*    public function messages(): array{
        return[
            'name.required' => 'El nombre es requerido'
        ];
    } */
    //  cuando haya problemas
  public function failedValidation(Validator $validator){
          $response = response()->json([
            'status' => false,
            'message' => 'validation error',
            'errors' => $validator->errors()
          ], 422);

          throw new \Illuminate\Validation\ValidationException($validator, $response);
    } 
}
