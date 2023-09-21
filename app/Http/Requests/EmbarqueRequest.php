<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmbarqueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'cliente_id' => 'required',
            'tipo_id' => 'required',
            'mes_id' => 'required',
            'referencia' => 'required|min:7|unique:embarques,referencia',
            'estado_id' => 'required',
            'documentacion_id' => 'required',
            'documentacion' => 'nullable',
            'file_id' => 'required',
            'prealertado' => 'required',
            'arribo' => 'nullable',
            'revalidación' => 'nullable',
            'pedimento' => 'nullable',
            'previo' => 'nullable|after_or_equal:arribo',
            'despacho' => 'nullable|after:arribo',
            'despacho_id' => 'required_if:estado_id,6',
            'cuenta_gastos' => 'nullable|after:previo',
            'pago_anticipo' => 'nullable',
            'uuid_cta_gastos' => 'required',
            'uuid' => 'required|uuid',
            'observaciones' => 'nullable',
            'observaciones_pedimento' => 'nullable'
        ];
    }
}
