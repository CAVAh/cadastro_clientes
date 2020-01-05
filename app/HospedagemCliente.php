<?php

namespace App;

use App\Utils\Format;

/**
 * @property mixed id
 * @property mixed nome
 * @property mixed sexo
 * @property mixed quarto_id
 * @property mixed cpf
 * @property mixed rg
 * @property mixed data_nasc
 * @property mixed profissao_id
 * @property mixed email
 * @property mixed endereco
 * @property mixed bairro_id
 * @property mixed cidade_id
 * @property mixed cep
 * @property mixed pais_id
 * @property mixed fone
 * @property mixed celular
 * @property mixed celular2
 * @property mixed data_entrada
 * @property mixed data_saida
 * @property mixed obs
 * @property mixed acompanhante1_nome
 * @property mixed acompanhante1_cpf
 * @property mixed acompanhante1_data_nasc
 * @property mixed acompanhante2_nome
 * @property mixed acompanhante2_cpf
 * @property mixed acompanhante2_data_nasc
 * @property mixed acompanhante3_nome
 * @property mixed acompanhante3_cpf
 * @property mixed acompanhante3_data_nasc
 * @property mixed conferido
 */
class HospedagemCliente extends CustomModel
{
    protected $table = 'hospedagem_clientes';
    protected $fillable = [
        'id',
        'nome',
        'sexo',
        'quarto_id',
        'quarto_nome',
        'cpf',
        'rg',
        'data_nasc',
        'profissao_id',
        'email',
        'endereco',
        'bairro_id',
        'cidade_id',
        'cep',
        'pais_id',
        'fone',
        'celular',
        'celular2',
        'data_entrada',
        'data_saida',
        'obs',
        'acompanhante1_nome',
        'acompanhante1_cpf',
        'acompanhante1_data_nasc',
        'acompanhante2_nome',
        'acompanhante2_cpf',
        'acompanhante2_data_nasc',
        'acompanhante3_nome',
        'acompanhante3_cpf',
        'acompanhante3_data_nasc',
        'conferido',
    ];
    protected $visible = ['id', 'quarto_nome', 'data_entrada', 'data_saida', 'conferido'];

    public function format() {
        if(!empty($this->data_entrada)) {
            $this->data_entrada = Format::dateToStr($this->data_entrada);
        }

        if(!empty($this->data_saida)) {
            $this->data_saida = Format::dateToStr($this->data_saida);
        }

        return parent::format();
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, $this->table);
    }
}
