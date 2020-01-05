<?php

namespace App;

use App\Utils\Format;

/**
 * @property mixed id
 * @property mixed quarto_id
 * @property mixed tipo_id
 * @property mixed portador_id
 * @property mixed grupo_id
 * @property mixed data_entrada
 * @property mixed data_saida
 * @property mixed valtotal
 * @property mixed nro_reserva
 * @property mixed obs
 * @property mixed conferido
 */
class Hospedagem extends CustomModel
{
    protected $table = 'hospedagens';
    protected $fillable = [
        'id',
        'quarto_id',
        'tipo_id',
        'portador_id',
        'grupo_id',
        'data_entrada',
        'data_saida',
        'valtotal',
        'nro_reserva',
        'obs',
        'conferido',
    ];
    protected $hidden = ['tipo_id', 'portador_id', 'obs', 'grupo_id', 'valtotal', 'nro_reserva', 'obs'];

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
        return $this->belongsToMany(Cliente::class, 'hospedagem_clientes');
    }
}
