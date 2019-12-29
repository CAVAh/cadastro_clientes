<?php

namespace App;

use App\Utils\Format;

/**
 * @property mixed id
 * @property mixed nome
 * @property mixed rg
 * @property mixed cpf
 * @property mixed profissao_id
 * @property mixed data_nasc
 * @property mixed sexo
 * @property mixed endereco
 * @property mixed cidade_id
 * @property mixed bairro_id
 * @property mixed cep
 * @property mixed fone
 * @property mixed celular
 * @property mixed celular2
 * @property mixed email
 * @property mixed obs
 * @property mixed cpf_conferido (CPF bate com o nome da pessoa)
 * @property mixed verificado (Verificado na receita federal, ou seja, data de aniversário/CPF/Nome confere com o que digitado)
 * @property mixed hospedou (Cliente se hospedou na pousada)
 */
class Cliente extends CustomModel
{
    protected $table = 'clientes';
    protected $fillable = [
        'id',
        'nome',
        'rg',
        'cpf',
        'profissao_id',
        'data_nasc',
        'sexo',
        'endereco',
        'cidade_id',
        'bairro_id',
        'cep',
        'fone',
        'celular',
        'celular2',
        'email',
        'obs',
        'cpf_conferido',
        'verificado',
        'hospedou',
    ];
    protected $hidden = [
        'rg', 'portador_id', 'sexo', 'endereco', 'cidade_id', 'bairro_id', 'cep', 'fone', 'celular', 'celular2', 'email', 'obs', 'cpf_conferido', 'verificado',
        'hospedou'
    ];

    public function format()
    {
        if (!empty($this->data_nasc)) {
            $this->data_nasc = Format::dateToStr($this->data_nasc);
        }

        return parent::format();
    }
}
