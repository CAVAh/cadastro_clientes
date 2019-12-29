<?php

namespace App;

use App\Utils\Format;

/**
 * @property mixed id
 * @property mixed tipo_id
 * @property mixed portador_id
 * @property mixed nome
 * @property mixed data_entrada
 * @property mixed data_saida
 * @property mixed obs
 * @property mixed valor_quarto
 */
class GrupoHospedagem extends CustomModel
{
    protected $table = 'grupo_hospedagens';
    protected $fillable = [
        'id',
        'tipo_id',
        'portador_id',
        'nome',
        'data_entrada',
        'data_saida',
        'obs',
        'valor_quarto'
    ];
    protected $hidden = ['tipo_id', 'portador_id', 'obs', 'valor_quarto'];

    public function format() {
        if(!empty($this->data_entrada)) {
            $this->data_entrada = Format::dateToStr($this->data_entrada);
        }

        if(!empty($this->data_saida)) {
            $this->data_saida = Format::dateToStr($this->data_saida);
        }

        return parent::format();
    }
}
