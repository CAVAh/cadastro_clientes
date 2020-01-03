<?php

namespace App\Http\Requests;

use App\Utils\Format;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed data_nasc
 * @property mixed cpf_conferido
 * @property mixed verificado
 * @property mixed hospedou
 */
class ClienteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'          => 'bail|required|between:3,80',
            'rg'            => 'bail|nullable',
            'cpf'           => 'bail|nullable|cpf',
            'profissao_id'  => 'bail|nullable|exists:profissoes,id',
            'data_nasc'     => 'bail|nullable|date_format:d/m/Y|before:today',
            'sexo'          => 'bail|in:M,F',
            'endereco'      => 'bail|nullable',
            'cidade_id'     => 'bail|nullable|exists:cidades,id',
            'bairro_id'     => 'bail|nullable|exists:bairros,id',
            'cep'           => 'bail|nullable|cep',
            'fone'          => 'bail|nullable|phone',
            'celular'       => 'bail|nullable|cellphone',
            'celular2'      => 'bail|nullable|cellphone',
            'email'         => 'bail|nullable|email',
            'obs'           => 'bail|nullable',
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

            if ($this->cep) {
                $merge['cep'] = Format::clearNumber($this->cep);
            }

            $merge['cpf_conferido'] = $this->cpf_conferido ? 1 : 0;
            $merge['verificado'] = $this->verificado ? 1 : 0;
            $merge['hospedou'] = $this->hospedou ? 1 : 0;

            $this->merge($merge);
        }
    }
}
