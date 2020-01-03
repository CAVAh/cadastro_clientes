<?php

namespace App\Http\Requests;

use App\Utils\Format;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HospedagemRequest
 * @package App\Http\Requests
 * @property mixed valtotal
 * @property mixed data_entrada
 * @property mixed data_saida
 * @property mixed conferido
 */
class HospedagemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quarto_id'    => 'bail|exists:quartos,id',
            'tipo_id'      => 'bail|nullable|exists:tipo_hospedagens,id',
            'portador_id'  => 'bail|nullable|exists:portadores,id',
            'grupo_id'     => 'bail|nullable|exists:grupo_hospedagens,id',
            'data_entrada' => 'bail|nullable|date_format:d/m/Y',
            'data_saida'   => 'bail|nullable|date_format:d/m/Y|after:data_entrada',
            'obs'          => 'bail|nullable',
            'nro_reserva'  => 'bail|nullable',
            'valtotal'     => 'bail|nullable|numeric|min:0',
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

        if ($this->valtotal) {
            $merge['valtotal'] = Format::strToFloat($this->valtotal);
        }

        $this->merge($merge);
    }

    public function messages()
    {
        return [
            'data_entrada.date_format' => __('validation.custom.date_format'),
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
        if ($this->validated()) {
            $merge = [];

            if ($this->data_saida) {
                $merge['data_saida'] = Format::strToDate($this->data_saida);
            }

            if ($this->data_entrada) {
                $merge['data_entrada'] = Format::strToDate($this->data_entrada);
            }

            $merge['conferido'] = $this->conferido ? 1 : 0;

            $this->merge($merge);
        }
    }
}
