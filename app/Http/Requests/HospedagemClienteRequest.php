<?php

namespace App\Http\Requests;

use App\Utils\Format;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed data_entrada
 * @property mixed data_saida
 * @property mixed data_nasc
 * @property mixed acompanhante1_data_nasc
 * @property mixed acompanhante2_data_nasc
 * @property mixed acompanhante3_data_nasc
 * @property mixed cep
 * @property mixed conferido
 */
class HospedagemClienteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'quarto_id'               => 'bail|exists:quartos,id',
            'data_entrada'            => 'bail|nullable|date_format:d/m/Y',
            'data_saida'              => 'bail|nullable|date_format:d/m/Y|after:data_entrada',
            'grupo_id'                => 'bail|nullable|exists:grupo_hospedagens,id',
            'obs_hosp'                => 'bail|nullable',
            'cpf'                     => 'bail|nullable|cpf|unique:clientes',
            'nome'                    => 'bail|required|between:3,80',
            'rg'                      => 'bail|nullable|max:13',
            'profissao_id'            => 'bail|nullable|exists:profissoes,id',
            'sexo'                    => 'bail|in:M,F',
            'data_nasc'               => 'bail|nullable|date_format:d/m/Y|before:today',
            'endereco'                => 'bail|nullable',
            'cidade_id'               => 'bail|nullable|exists:cidades,id',
            'bairro_id'               => 'bail|nullable|exists:bairros,id',
            'cep'                     => 'bail|nullable|cep',
            'fone'                    => 'bail|nullable|phone',
            'celular'                 => 'bail|nullable|cellphone',
            'celular2'                => 'bail|nullable|cellphone',
            'email'                   => 'bail|nullable|email',
            'obs_cli'                 => 'bail|nullable',
            'acompanhante1_nome'      => 'bail|nullable|between:3,80',
            'acompanhante1_cpf'       => 'bail|nullable|cpf|unique:clientes',
            'acompanhante1_data_nasc' => 'bail|nullable|date_format:d/m/Y|before:today',
            'acompanhante2_nome'      => 'bail|nullable|between:3,80',
            'acompanhante2_cpf'       => 'bail|nullable|cpf|unique:clientes',
            'acompanhante2_data_nasc' => 'bail|nullable|date_format:d/m/Y|before:today',
            'acompanhante3_nome'      => 'bail|nullable|between:3,80',
            'acompanhante3_cpf'       => 'bail|nullable|cpf|unique:clientes',
            'acompanhante3_data_nasc' => 'bail|nullable|date_format:d/m/Y|before:today',
        ];

        // update
        if ($this->getMethod() == 'PUT') {
            $rules['cpf']               = 'bail|nullable|cpf|unique:clientes,cpf,' . $this->id . ',id';
            $rules['acompanhante1_cpf'] = 'bail|nullable|cpf|unique:clientes,cpf,' . $this->id . ',id';
            $rules['acompanhante2_cpf'] = 'bail|nullable|cpf|unique:clientes,cpf,' . $this->id . ',id';
            $rules['acompanhante3_cpf'] = 'bail|nullable|cpf|unique:clientes,cpf,' . $this->id . ',id';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'data_entrada.date_format'            => __('validation.custom.date_format'),
            'data_saida.date_format'              => __('validation.custom.date_format'),
            'data_nasc.date_format'               => __('validation.custom.date_format'),
            'acompanhante1_data_nasc.date_format' => __('validation.custom.date_format'),
            'acompanhante2_data_nasc.date_format' => __('validation.custom.date_format'),
            'acompanhante3_data_nasc.date_format' => __('validation.custom.date_format'),
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

            if ($this->data_nasc) {
                $merge['data_nasc'] = Format::strToDate($this->data_nasc);
            }

            if ($this->acompanhante1_data_nasc) {
                $merge['acompanhante1_data_nasc'] = Format::strToDate($this->acompanhante1_data_nasc);
            }

            if ($this->acompanhante2_data_nasc) {
                $merge['acompanhante2_data_nasc'] = Format::strToDate($this->acompanhante2_data_nasc);
            }

            if ($this->acompanhante3_data_nasc) {
                $merge['acompanhante3_data_nasc'] = Format::strToDate($this->acompanhante3_data_nasc);
            }

            if ($this->data_saida) {
                $merge['data_saida'] = Format::strToDate($this->data_saida);
            }

            if ($this->data_entrada) {
                $merge['data_entrada'] = Format::strToDate($this->data_entrada);
            }

            if ($this->cep) {
                $merge['cep'] = Format::clearNumber($this->cep);
            }

            $merge['conferido'] = $this->conferido ? 1 : 0;

            $this->merge($merge);
        }
    }
}
