<?php

namespace App\Http\Requests;

use App\Utils\Format;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed data_entrada
 * @property mixed data_saida
 * @property mixed valor_quarto
 */
class GrupoHospedagemRequest extends FormRequest
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
            'tipo_id'      => 'bail|nullable|exists:tipo_hospedagens,id',
            'portador_id'  => 'bail|nullable|exists:portadores,id',
            'nome'         => 'bail|required|between:3,50',
            'data_entrada' => 'bail|nullable|date_format:d/m/Y',
            'data_saida'   => 'bail|nullable|date_format:d/m/Y',
            'obs'          => 'bail|nullable',
            'valor_quarto' => 'bail|nullable|numeric'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $merge = [];

        if($this->valor_quarto) {
            $merge['valor_quarto'] = Format::strToFloat($this->valor_quarto);
        }

        $this->merge($merge);
    }

    public function messages()
    {
        return [
            'data_saida.date_format' => __('validation.custom.date_format')
        ];
    }

    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function () {
            // Call the after method of the FormRequest (see below)
            $this->after();
        });
    }

    public function after()
    {
        if($this->validated()) {
            $merge = [];

            if($this->data_saida) {
                $merge['data_saida'] = Format::strToDate($this->data_saida);
            }

            if($this->data_entrada) {
                $merge['data_entrada'] = Format::strToDate($this->data_entrada);
            }

            $this->merge($merge);
        }
    }
}
