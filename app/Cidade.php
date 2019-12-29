<?php

namespace App;

/**
 * @property mixed id
 * @property mixed nome
 * @property mixed estado
 * @property mixed pais
 * @property mixed cep_padrao
 * @property mixed cod_ibge
 * @property mixed ddd
 * @property mixed estado_id
 */
class Cidade extends CustomModel
{
    protected $table = 'cidades';
    protected $fillable = ['id', 'nome', 'estado', 'pais', 'cep_padrao', 'cod_ibge', 'ddd', 'estado_id'];
    protected $hidden = ['estado_id'];

    public function format() {
        if($this->cep_padrao) {
            $this->cep_padrao = \App\Utils\Format::formatCEP($this->cep_padrao);
        }

        return parent::format();
    }
}
