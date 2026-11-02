<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class AnimalDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
        #return False; cuando un usuario normal NO puede agregar datos... se necesitarían ciertos permisos
    }

    public function prepareForValidation(){

        if ($this->has('name')){
            $this->merge([
                'name'=> Str::title(trim($this->input('name'))), #merge= arregla las mayus y minus 
            ]);
        }

        if ($this->has('species')){
            $this->merge([
                'species'=> Str::lower(trim($this->input('species'))), # (el filtro de especies yo lo tengo comentado)
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20', #|min:2
            'species_id' => 'required|integer|exists:species,id', #que exista en la tabla species como id
            #'species' => 'required|string|max:20|in: perro, gato, loro, elefante, conejo, caballo, zorro, oveja', 
            'age' => 'required|numeric|min:0|max:999'
        ];
    }

    public function messages(): array{

    return[
        'name.required' => 'El nombre es obligatorio.',
        'name.string' => 'El nombre debe ser una cadena de texto.',
        'name.max' => 'El nombre no puede tener más de :max carácteres.',
        'species_id.required' => 'La especie es obligatoria.',
        'species_id.integer' => 'num entero',
        'species_id.exists' => 'La especie seleccionada no es válida.',
        #'species.string' => 'La especie debe ser una cadena de texto.',
        #'species.max' => 'La especie no puede tener más de :max carácteres.',
        #'species.in' => 'La especie ":input" no es válida. Puede ser: :values',
        'age.required' => 'Indicar edad.',
        'age.numeric' => 'Sólo se permiten números.',
        'age.min' => 'La edad debe ser mayor de :min.',
        'age.max' => 'La edad debe ser menor de :max.'
    ];
    #nota: ":input" → muestra en pantalla lo que escribió el usuario, tipo "La especie ""tarara" no es válida
    #puede ser ":values" → muestra el filtro  = perro, gato, pez, elefante, conejo, caballo, zorro
    }
}