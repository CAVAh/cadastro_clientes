<?php

namespace App;

/**
 * @property mixed nome
 * @property mixed id
 */
class TipoHospedagem extends CustomModel
{
    protected $table = 'tipo_hospedagens';
    protected $fillable = ['id', 'nome'];
}
